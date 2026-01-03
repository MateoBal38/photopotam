<?php

use App\Http\Controllers\Main;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PhotoController;

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
    return view('welcome');
});

Route::resource('album', AlbumController::class)->except(['edit', 'update']);
Route::resource('photo', PhotoController::class)->except(['index', 'show', 'create', 'edit', 'update']);

Route::get('/', [Main::class, 'index']);

Route::get('/perso', [Main::class, 'perso'])->middleware('auth');
