<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public static function index(Request $request) {
        return response(Series::all(), 200);
    }

    public static function show(Request $request, $id) {
        $series = Series::find($id);
        if ($series) {
            return $series;
        } else {
            return response([
                'code' => 'SERIES_NOT_FOUND',
                'message' => 'Series requested is not found',
            ], 404);
        }
    }

    public static function store(Request $request) {
        if (!$request->input('name')) {
            return response([
                'code' => 'SERIES_MISSING_NAME',
                'message' => 'Cannot save series due to missing name',
            ], 400);
        }

        $series = new Series();
        $series->name = $request->input('name') ? : abort(400);
        $series->description = $request->input('description') ? : '-';
        $series->save();

        return $series;
    }

    public static function update(Request $request, $id) {
        $series = Series::find($id);
        if ($series) {
            $series->name = $request->input('name') ? : $series->name;
            $series->description = $request->input('description') ? : $series->description;
            $series->save();

            return $series;
        } else {
            return response([
                'code' => 'SERIES_NOT_FOUND',
                'message' => 'Series requested is not found',
            ], 404);
        }
    }

    public static function destroy(Request $request, $id) {
        $series = Series::find($id);
        if ($series) {
            foreach ($series->entries as $entry) {
                $entry->delete();
            }
            $series->delete();
            return $series;
        } else {
            return response([
                'code' => 'SERIES_NOT_FOUND',
                'message' => 'Series requested is not found',
            ], 404);
        }
    }
}
