<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', [AuthController::class,'login'])->name('login');

Route::get('/inscrire', [AuthController::class, 'register'])->name('signUp');
Route::post('/register', [AuthController::class,'registerPost'])->name('signUpPost');
Route::get('/forgot', [AuthController::class, 'forget'])->name("forget");
Route::post("/foget", [AuthController::class,"forgetPost"])->name("forgetPost");
Route::post("/forgetLast", [AuthController::class,"forgetLast"])->name("newPass");
Route::post("newpasschange", [AuthController::class,"newpasschange"])->name("newpasschange");