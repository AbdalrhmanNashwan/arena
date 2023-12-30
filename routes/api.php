<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('uploadSession', [App\Http\Controllers\GsessionsController::class, 'store']);
Route::post('uploadExpense', [App\Http\Controllers\ExpenseController::class, 'store']);
Route::post('uploadDebt', [App\Http\Controllers\DebtController::class, 'store']);
//create a route for register
Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
