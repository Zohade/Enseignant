<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\PublicationController;
use App\Models\Departement;
use App\Models\Publication;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', [AuthController::class,'login'])->name('login');
Route::post('/login', [AuthController::class,'loginPost'])->name('loginPost');
Route::get('/logout', [AuthController::class,'logout'])->name('logout');

Route::get('/inscrire', [AuthController::class, 'register'])->name('signUp');
Route::post('/register', [AuthController::class,'registerPost'])->name('signUpPost');
Route::get('/confirmerInscription/{userId}',[AuthController::class,'confirmerinscript'])->name('confirmerInscript');
Route::get('/forgot', [AuthController::class, 'forget'])->name("forget");
Route::post("/foget", [AuthController::class,"forgetPost"])->name("forgetPost");
Route::get('/forgetLast/{userId}',[AuthController::class,'forgetLast'])->name('forgetLast');
Route::post("newpasschange", [AuthController::class,"newpasschange"])->name("newpasschange");

//route Ajax
Route::get('/get-villes/{departementId}', [DepartementController::class, 'getVilles']);
Route::get('/get-arrondissements/{villeId}', [VilleController::class, 'getArrondissements']);
Route::get('/index', function () {
    return view('afterAuth.index');
})->name('dash')->middleware('auth');

    //Publication
Route::resource('publication', PublicationController::class)->middleware('auth');
