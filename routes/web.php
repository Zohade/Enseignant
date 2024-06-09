<?php

use App\Http\Controllers\AcceuilControlleur;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\ProfilControleur;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CirconscriptionController;
use App\Http\Controllers\EcoleController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\ClasseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('first');

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
Route::get('/get-circons/{villeId}', [CirconscriptionController::class, 'getCircons']);
Route::get('/get-ecoles/{circonscriptionId}', [EcoleController::class, 'getEcoles']);
Route::get('/get-groupes/{ecoleId}', [GroupeController::class, 'getGroupes']);
Route::get('/get-classes/{groupeId}', [ClasseController::class, 'getClasses']);

Route::middleware('auth')->group(function () {
    //route de base
    Route::get('/index', [AcceuilControlleur::class, 'index'])->name('dash');

    //Publication
    Route::resource('publication', PublicationController::class);
    Route::post('/profil', [ProfilControleur::class, 'store'])->name('profil.store');
    Route::get('profil/index/{userId}', [ProfilControleur::class, 'index'])->name('profil.index');
    Route::resource('user', UserController::class);
    Route::resource('circonscription', CirconscriptionController::class);
    Route::resource('ecole', EcoleController::class);
    Route::resource('groupe', GroupeController::class);
    Route::resource('classe', ClasseController::class);
});