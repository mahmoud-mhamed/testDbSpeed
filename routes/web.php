<?php

use Illuminate\Support\Facades\Route;

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
use \App\Actions;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/lorem',\App\Actions\LoremIndexAction::class)->name('lorem');
Route::post('/search',\App\Actions\SearchStoreAction::class)->name('search');
Route::get('/truncate-result',\App\Actions\TruncateResultAction::class)->name('truncate-result');
