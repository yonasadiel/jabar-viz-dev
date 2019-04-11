<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public static function index(Request $request) {
        return Series::all();
    }

    public static function store(Request $request) {
        $series = new Series();
        $series->name = $request->input('name');
        $series->description = $request->input('description') ? : '-';
        $series->save();

        return $series;
    }
}
