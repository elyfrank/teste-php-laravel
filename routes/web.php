<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\FileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/queue', function () {
    return view('queue');
})->name('queue');

Route::post('/upload-file', [FileController::class, 'upload'])->name('upload-file');

Route::post('/queue-work', [QueueController::class, 'work'])->name('queue-work');