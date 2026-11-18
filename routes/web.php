<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\BorrowingController;

Route::get('/', function () {
    return view('welcome');
});


