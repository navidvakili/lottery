<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\ExecuteController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LotteryController;
use App\Http\Controllers\LotteryExcelController;
use App\Http\Controllers\SmsController;
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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [ExecuteController::class, 'index'])->name('exceute.index');
    Route::get('/dashboard', [ExecuteController::class, 'index'])->name('exceute.index');
    Route::post('/', [ExecuteController::class, 'store'])->name('execute.store');

    Route::resource('groups', GroupController::class);

    Route::get('lottery/excel', [LotteryExcelController::class, 'import'])->name('lottery.excel.import');
    Route::post('lottery/excel', [LotteryExcelController::class, 'store'])->name('lottery.excel.store');

    Route::post('lottery/sms/{lottery}', [SmsController::class, 'lottery_send'])->name('lottery.sms');

    Route::resource('lottery', LotteryController::class);
    Route::get('lottery/default/{lottery}', [LotteryController::class, 'default'])->name('lottery.default');

    Route::get('excel', [ExcelController::class, 'import'])->name('excel.import');
    Route::post('excel', [ExcelController::class, 'store'])->name('excel.store');
    Route::get('export/{lottery}', [ExcelController::class, 'export'])->name('excel.export');



    Route::get('clients/{group}', [ClientController::class, 'index'])->name('clients.index');
    Route::delete('clients/{client}/destroy', [ClientController::class, 'destroy'])->name('clients.destroy');
});
