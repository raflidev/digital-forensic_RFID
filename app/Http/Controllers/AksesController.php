<?php

namespace App\Http\Controllers;

use App\Models\Akses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Csv\Writer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use ZipArchive;

class AksesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($card, $door)
    {
        $akses = new Akses;
        $akses->card_id = $card;
        $akses->door_id = $door;
        $akses->save(); 

        return response()->json([
            'message' => 'Akses berhasil ditambahkan',
            'data' => $akses
        ]);
    }

    public function downloadCsv()
    {
        $data = DB::table('akses')->get(); // Replace 'your_table_name' with the actual table name

        $csv = Writer::createFromFileObject(new \SplTempFileObject());

        // Add header row
        $csv->insertOne(array_keys((array) $data->first()));

        // Add data rows
        // foreach ($data as $row) {
        //     $csv->insertOne((array) $row);
        // }

        $filename = 'data.csv';
        Storage::put('csv/' . $filename, $csv->getContent());

        $file_path = "../storage/app/csv/".$filename;
        // dd($file_path);
        if (File::exists($file_path)) {
            $hash = hash_file('sha256', $file_path);
            // Now $hash contains the SHA-256 hash of the file
            // dd($hash);
            Storage::put('csv/' . $hash.'.csv', $csv->getContent());
        } else {
            // Handle the case where the file doesn't exist
            dd("File not found.");
        }

        // return Storage::download('csv/' . $hash.'.csv');
        // multiple storage download
        $zipname = 'download-data.zip';
        $zip = new \ZipArchive;
        $zip->open($zipname, \ZipArchive::CREATE);
        $zip->addFile('../storage/app/csv/'.$hash.'.csv', 'data.csv');
        $zip->addFile('../storage/app/csv/'.$hash.'.csv', $hash);
        $zip->close();
        return response()->download($zipname);

    }

    /**
     * Display the specified resource.
     */
    public function show(Akses $akses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Akses $akses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Akses $akses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Akses $akses)
    {
        //
    }
}
