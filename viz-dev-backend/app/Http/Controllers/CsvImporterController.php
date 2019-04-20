<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Importer\EntriesImporter;
use App\Models\Series;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToCollection;

class CsvImporterController extends Controller implements ToCollection
{
    public static function importEntries(Request $request, $id) {
        $series = Series::find($id);
        if ($series) {
            if ($request->hasFile('series')) {
                try {
                    $file_path = $request->file('series')->getRealPath();
                    $data = Excel::import(new EntriesImporter($series), $file_path);
                } catch (Exception $e) {
                    return response([
                        'code' => 'UNKNOWN_ERROR',
                        'message' => $e->getMessage(),
                    ], 500);
                }
            } else {
                return response([
                    'code' => 'FILE_NOT_FOUND',
                    'message' => 'File is empty',
                ], 400);
            }
        } else {
            return response([
                'code' => 'SERIES_NOT_FOUND',
                'message' => 'Series requested is not found',
            ], 404);
        }
    }
}
