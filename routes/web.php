<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ValidMailController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\AppelOffreController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\SelectionController;
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
    Route::get('/appel-offre', [AppelOffreController::class, 'index'])->name('appel-offre.index');
    Route::get('/appel-offre/create', [AppelOffreController::class, 'create'])->name('appel-offre.create');
    Route::post('/appel-offre/store', [AppelOffreController::class, 'store'])->name('appel-offre.store');

    Route::get('/candidature', [CandidatureController::class, 'index'])->name('candidature.index');


    Route::get('/valid_mail/index', [ValidMailController::class,'index'])->name('valid_mail.index');
    Route::get('/valid_mail/create', [ValidMailController::class,'create'])->name('valid_mail.create');
    Route::post('/valid_mail/store', [ValidMailController::class,'store'])->name('valid_mail.store');

    Route::resource('valid_mail', ValidMailController::class)->except(['show', 'edit', 'update']);

    Route::get('/selection/create/{id}', [SelectionController::class, 'create'])->name('selection.create');
    Route::post('/selection/store', [SelectionController::class, 'store'])->name('selection.store');

    Route::get('/selection/filter', [SelectionController::class, 'filter'])->name('selection.filter');
    Route::get('/selection/best_match/{appelOffreId}', [SelectionController::class, 'bestMatch'])->name('selection.best_match');

    Route::get('/stage/create/appelOffre={id}', 'UserController@index')->name('user');
});

/*Route::middleware(['auth', 'medium_employer'])->group(function () {
    Route::get('/candidature', [CandidatureController::class, 'index'])->name('candidature.index');

    Route::get('/selection/create/{id}', [SelectionController::class, 'create'])->name('selection.create');
    Route::post('/selection/store', [SelectionController::class, 'store'])->name('selection.store');

    Route::get('/selection/filter', [SelectionController::class, 'filter'])->name('selection.filter');
    Route::get('/selection/best_match/{appelOffreId}', [SelectionController::class, 'bestMatch'])->name('selection.best_match');
});*/

Route::get('/etudiants/create', [EtudiantController::class, 'create'])->name('etudiants.create');
Route::post('/etudiants/store', [EtudiantController::class, 'store'])->name('etudiants.store');

Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/etudiants/edit', [EtudiantController::class, 'edit'])->middleware('student')->name('etudiants.edit');
    Route::post('/etudiants', [EtudiantController::class, 'update'])->middleware('student')->name('etudiants.update');
});

//modification de la langue
Route::get('lang/{locale}', [LanguageController::class, 'changeLanguage'])->name('lang.change');


require __DIR__.'/auth.php';
