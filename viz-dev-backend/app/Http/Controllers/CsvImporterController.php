<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Importer\EntriesImporter;
use App\Models\Series;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToCollection;

class CsvImporterController extends Controller
{
    public static function importEntries(Request $request, $id) {
        $series = Series::find($id);
        if ($series) {
            if ($request->hasFile('series')) {
                try {
                    $ext = $request->file('series')->getClientOriginalExtension();
                    $ext_type = null;
                    if ($ext === 'csv') {
                        $ext_type = \Maatwebsite\Excel\Excel::CSV;
                    } else if ($ext == 'xls') {
                        $ext_type = \Maatwebsite\Excel\Excel::XLS;
                    } else if ($ext == 'xlsx') {
                        $ext_type = \Maatwebsite\Excel\Excel::XLSX;
                    } else {
                        return response([
                            'code' => 'UNKNOWN_EXTENSION',
                            'message' => 'Unknown extension: ' . $ext,
                        ], 500);
                    }
                    $data = Excel::import(new EntriesImporter($series), $request->file('series'), 'local', $ext_type);
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
