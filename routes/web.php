<?php

use App\Http\Controllers\PhoneController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Symfony\Component\ErrorHandler\Debug;

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
    Debugbar::info("Sve je ok");
    return view('welcome');
});


// Route::get('/phones', [PhoneController::class, 'index']);

Route::resource('/phones', PhoneController::class);
