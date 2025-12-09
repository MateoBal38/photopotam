<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main;

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

Route::get('/', [Main::class, 'index']);
Route::get('/album', [Main::class, 'album']);
Route::get('/detailAlbum/{id}', [Main::class, 'detailAlbum'])->where("id", "[0-999]+");
// Route::get('/login', [Main::class, 'login']);
// Route::get('/register', [Main::class, 'register']);
Route::get('/create_album', [Main::class, 'create_album'])->middleware('auth');
Route::post('/store_album', [Main::class, 'store_album'])->middleware('auth');

Route::get('/perso', [Main::class, 'perso'])->middleware('auth');

// Route::get('/logout', [Main::class, 'logout']);
