<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AksesController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Models\Akses;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    // akses join card and door
    $data = Akses::join('card', 'card.card_id', '=', 'akses.card_id')
        ->join('door', 'door.door_id', '=', 'akses.door_id')
        ->select('akses.*', 'card.nama as nama_card', 'door.nama as nama_door')
        ->get();
    // dd($data);
    return Inertia::render('Dashboard', ['datas' => $data]);
    // return Inertia::render('Dashboard', ['datas' => Akses::all()->map(function($akses){
    //     return [
    //         'id' => $akses->id,
    //         'card_id' => $akses->card_id,
    //         'door_id' => $akses->door_id,
    //         'created_at' => $akses->created_at,
    //         'updated_at' => $akses->updated_at,
    //     ];
    // })]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/download-csv', [AksesController::class, 'downloadCsv']);

require __DIR__.'/auth.php';
