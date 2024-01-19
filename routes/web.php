<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomAuth;
use App\Http\Controllers\dashBoardController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\incomeController;
use App\Http\Controllers\Settings;
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
    //dashboard routes
    Route::get('/home', [dashBoardController::class, 'show'])->name('home');
    Route::get('/expenses', [ExpenseController::class, 'show'])->name('expenses');
    Route::get('/debts', [DebtController::class, 'show'])->name('debts');
    Route::get('/sessions', [GsessionsController::class, 'allSessions'])->name('sessions');
    Route::get('/settings', [Settings::class, 'show'])->name('settings');
    Route::get('/income', [incomeController::class, 'show'])->name('income');
    //debts routes
    Route::patch('/debts/{debt}/update-paid-status', [DebtController::class, 'updatePaidStatus'])->name('debt.updatePaidStatus');
    Route::delete('/debts/{debt}', [DebtController::class, 'destroy'])->name('debt.destroy');
    Route::patch('/debt/{debt}/updateAmount', [DebtController::class, 'updateAmount'])->name('debt.updateAmount');
    Route::post('/debts', [DebtController::class, 'storeDebt'])->name('debt.store');
    //expense routes
    Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expense.destroy');
    Route::patch('/expenses/{expense}/updateAmount', [ExpenseController::class, 'updateAmount'])->name('expense.updateAmount');
    Route::post('/expenses', [ExpenseController::class, 'storeExpense'])->name('expense.store');
    //sessions routes
    Route::delete('/sessions/{session}', [GsessionsController::class, 'destroy'])->name('session.destroy');
    //update session for total_cost + cost_after_promo + promo
    Route::patch('/sessions/{session}/update', [GsessionsController::class, 'update'])->name('session.update');

    Route::post('/CustomRegister', [CustomAuth::class, 'create'])->name('CustomRegister');
}
);

////create route for login.blade.php from auth controller with two parameter
//Route::post('login.blade.php', [AuthController::class, 'login'])->name('login.blade.php');

Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
