<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
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
    return view('welcome');
})->name('welcome');

Route::get('register',[Controller::class,'register'])->name('register');
Route::post('registersave',[Controller::class,'registersave'])->name('registersave');



Route::get('login',[Controller::class,'login'])->name('login');
Route::post('loginsave',[Controller::class,'loginsave'])->name('loginsave');
Route::get('logout',[Controller::class,'logout'])->name('logout');

Route::group(['middleware' => ['PreventbackButton', 'auth']], function(){


        Route::get('Dashboard',[Controller::class,'Dashboard'])->middleware('auth')->name('Dashboard');

        Route::group([ExpenseController::class], function () {
            Route::get('expense',[ExpenseController::class,'Expense'])->name('expense')->middleware('auth');
            Route::post('add-expense',[ExpenseController::class,'addExpense'])->name('add-expense');
            Route::get('view-expense',[ExpenseController::class,'viewExpense'])->name('view-expense');
        });

        Route::get('report',[ReportController::class,'report'])->middleware('auth')->name('report');
        Route::get('filter-expenses',[ReportController::class,'filterExpenses'])->name('filter-expenses');
        Route::get('export-expenses',[ReportController::class,'exportexpenses'])->name('export-expenses');


        Route::get('setting',[SettingController::class,'Setting'])->middleware('auth')->name('setting');
        Route::post('edit-profile',[SettingController::class,'editprofile'])->name('edit-profile');



        Route::get('verifyemail/{token}',[Controller::class,'verifyemail'])->name('verifyemail');


});
