<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GsessionsController;

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

//Route::get('/', function () {
//    return view('login');
//});\

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/home',[    GsessionsController::class,'show'] )->name('home');
    Route::get('/expenses',[ExpenseController::class,'show'] )->name('expenses');
    Route::get('/debts',[DebtController::class,'show'] )->name('debts');
    Route::get('/sessions',[GsessionsController::class,'allSessions'] )->name('sessions');
    Route::get('/settings',[ExpenseController::class,'show'] )->name('settings');}
);

////create route for login.blade.php from auth controller with two parameter
//Route::post('login.blade.php', [AuthController::class, 'login'])->name('login.blade.php');

Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
