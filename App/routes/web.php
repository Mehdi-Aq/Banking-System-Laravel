<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('transfer', [App\Http\Controllers\TransactionController::class, 'indexOptions'])->middleware('auth');

Route::post('/transfer/confirmation', [App\Http\Controllers\TransactionController::class, 'store'])->middleware('auth');

Route::put('/transactions/{id}', [App\Http\Controllers\TransactionController::class, 'update'])->middleware('auth');

// Send payment
Route::get('transfer/contact', [App\Http\Controllers\ContactController::class, 'create'])->middleware('auth');
Route::post('transfer/contact', [App\Http\Controllers\ContactController::class, 'storeAtTransfer'])->middleware('auth');
Route::post('transfer', [App\Http\Controllers\TransactionController::class, 'store'])->middleware('auth');
Route::get('transfer/confirmation', [App\Http\Controllers\TransactionController::class, 'show'])->middleware('auth');

// Manage contacts
Route::get('contacts', [App\Http\Controllers\ContactController::class, 'index'])->middleware('auth');
Route::post('contacts', [App\Http\Controllers\ContactController::class, 'store'])->middleware('auth');
Route::delete('contacts/delete/{contact}', [App\Http\Controllers\ContactController::class, 'destroy'])->middleware('auth')->name('contact.destroy');

// Accounts summary
Route::resource('accounts', 'App\Http\Controllers\AccountController')->middleware('auth');

// Pending incoming transfers
Route::get('transfers/pending/incoming', [App\Http\Controllers\TransactionController::class, 'indexIncoming'])->middleware('auth');
Route::get('transfers/pending/outgoing', [App\Http\Controllers\TransactionController::class, 'indexOutgoing'])->middleware('auth');

// User details
Route::resource('users', 'App\Http\Controllers\UserController')->middleware('auth');


