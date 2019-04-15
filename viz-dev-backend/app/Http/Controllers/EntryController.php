<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Entry;
use App\Models\Series;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public static function index(Request $request, $series_id) {
        $series = Series::find($series_id);
        if ($series) {
            return $series->entries;
        } else {
            return response([
                'code' => 'SERIES_NOT_FOUND',
                'message' => 'Series requested is not found',
            ], 404);
        }
    }

    public static function show(Request $request, $series_id, $cities_id, $year) {
        $series = Series::find($series_id);
        $city = City::find($cities_id);

        if (!$series) {
            return response([
                'code' => 'SERIES_NOT_FOUND',
                'message' => 'Series requested is not found',
            ], 404);
        }

        if (!$city) {
            return response([
                'code' => 'CITY_NOT_FOUND',
                'message' => 'City requested is not found',
            ], 404);
        }

        $entry = Entry::where([
            ['series_id', '=', $series_id],
            ['cities_id', '=', $cities_id],
            ['year', '=', $year],
        ])->first();

        if ($entry) {
            return response($entry, 200);
        } else {
            return response([
                'code' => 'ENTRY_NOT_FOUND',
                'message' => 'Entry is not found',
            ], 404);
        }
    }

    public static function upsert(Request $request, $series_id, $cities_id, $year) {
        $series = Series::find($series_id);
        $city = City::find($cities_id);

        if (!$series) {
            return response([
                'code' => 'SERIES_NOT_FOUND',
                'message' => 'Series requested is not found',
            ], 404);
        }

        if (!$city) {
            return response([
                'code' => 'CITY_NOT_FOUND',
                'message' => 'City requested is not found',
            ], 404);
        }

        if (!$request->input('value')) {
            return response([
                'code' => 'ENTRY_MISSING_VALUE',
                'message' => 'Entry value must be present',
            ], 400);
        }

        $entry = Entry::where([
            ['series_id', '=', $series_id],
            ['cities_id', '=', $cities_id],
            ['year', '=', $year],
        ])->first();

        if ($entry) {
            $entry->value = $request->input('value');
            $entry->save();

            return response($entry, 200);
        } else {
            $entry = new Entry();
            $entry->series_id = $series_id;
            $entry->cities_id = $cities_id;
            $entry->year = $year;
            $entry->value = $request->input('value');
            $entry->save();

            return response($entry, 201);
        }
    }
}
