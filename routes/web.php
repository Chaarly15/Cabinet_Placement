<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ValidMailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/cabinet-de-placement')->name('cabinet-de-placement.')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'super_employer'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

//Route::middleware(['auth', 'super_employer'])->group(function () {
    Route::get('/register-super-employer', [RegisterController::class, 'showSuperEmployerRegisterForm'])->name('register.super_employer');
    Route::post('/register-super-employer', [RegisterController::class, 'createSuperEmployer']);
//});

Route::middleware(['auth', 'super_employer'])->group(function () {
    /*Route::get('/register-super-employer', [RegisterController::class, 'showSuperEmployerRegisterForm'])->name('register.super_employer');
    Route::post('/register-super-employer', [RegisterController::class, 'createSuperEmployer']);*/

    Route::get('/valid_mail/index', [ValidMailController:: class,'index'])->name('valid_mail.index');
    Route::get('/valid_mail/create', [ValidMailController:: class,'create'])->name('valid_mail.create');
    Route::post('/valid_mail/store', [ValidMailController:: class,'store'])->name('valid_mail.store');

    Route::resource('valid_mail', ValidMailController::class)->except(['show', 'edit', 'update']);
});

Route::get('/etudiants/create', [EtudiantController::class, 'create'])->name('etudiants.create');
Route::post('/etudiants/store', [EtudiantController::class, 'store'])->name('etudiants.store');

Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/etudiants/edit', [EtudiantController::class, 'edit'])->middleware('student')->name('etudiants.edit');
    Route::post('/etudiants', [EtudiantController::class, 'update'])->middleware('student')->name('etudiants.update');
});

require __DIR__.'/auth.php';
