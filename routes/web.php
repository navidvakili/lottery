<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LotteryController;
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

Route::get('/', function () {
    return view('dashboard');
});


Route::resource('groups', GroupController::class);
Route::resource('lottery', LotteryController::class);
Route::get('excel', [ExcelController::class, 'import'])->name('excel.import');
Route::post('excel', [ExcelController::class, 'store'])->name('excel.store');

Route::get('clients/{group}', [ClientController::class, 'index'])->name('clients.index');
Route::delete('clients/{client}/destroy', [ClientController::class, 'destroy'])->name('clients.destroy');
