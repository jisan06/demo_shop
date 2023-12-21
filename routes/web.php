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
use App\Http\Controllers\TransactionController;
Route::get('/', [TransactionController::class, 'create'])->name('transaction.create');
Route::post('/transaction/store', [TransactionController::class, 'store'])->name('transaction.store');
