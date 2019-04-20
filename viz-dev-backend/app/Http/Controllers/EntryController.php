<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Entry;
use App\Models\Series;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public static function asCsv(Request $request) {
        $start_year = Entry::min('year');
        $end_year = Entry::max('year');
        $headers = ['regency', 'indicator', ];
        for ($year = $start_year; $year <= $end_year; $year++) {
            $headers[] = "{$year}";
        }
        $csv_rows = [join(';', $headers)];

        $series = Series::all();
        $cities = City::all();
        $entries = Entry::all();
        $entry_rows = [];
        foreach ($series as $_series) {
            $entry_rows[$_series->name] = [];
            foreach ($cities as $city) {
                $entry_rows[$_series->name][$city->name] = [];
            }
        }

        foreach ($entries as $entry) {
            $entry_rows[$entry->series->name][$entry->city->name][$entry->year] = $entry->value;
        }

        foreach ($entry_rows as $series_name => $entry_series) {
            foreach ($entry_series as $city_name => $entry_series_city) {
                $row = [$city_name, $series_name];
                for ($year = $start_year; $year <= $end_year; $year++) {
                    if (array_key_exists($year, $entry_series_city)) {
                        $value = $entry_series_city[$year];
                        $row[] = "{$value}";
                    } else {
                        $row[] = ' ';
                    }
                }
                $csv_rows[] = join(';', $row);
            }
        }

        return response(join("\n", $csv_rows), 200)->header('Content-Type', 'text/csv');;
    }

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

        list($entry, $created) = Entry::upsert([
            'series_id' => $series_id,
            'cities_id' => $cities_id,
            'year' => $year,
            'value' => $request->input('value'),
        ]);

        if ($created) {
            return response($entry, 201);
        } else {
            return response($entry, 200);
        }
    }
}
