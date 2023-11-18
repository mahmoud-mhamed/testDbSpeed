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

Route::get('/test-full-text',\App\Actions\FullTextAction::class)->name('test-full-text');
