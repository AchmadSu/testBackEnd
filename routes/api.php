<?php

use App\Models\Books;
use App\Models\Loans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\ReturnsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Members
Route::controller(MembersController::class)->group(function(){
    Route::get('members', 'index')->name('get all members');
});

// Books
Route::controller(BooksController::class)->group(function(){
    Route::get('books', 'index')->name('get all books');
});

// Loans
Route::controller(LoansController::class)->group(function(){
    Route::post('loans', 'create')->name('add loans');
});

// Returns
Route::controller(ReturnsController::class)->group(function(){
    Route::post('returns', 'create')->name('add loans');
});
