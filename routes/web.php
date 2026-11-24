<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index']);

Route::post('/question/store', [QuestionController::class, 'store'])->name('question.store');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('checkislogin');

Route::resource('pelanggan', PelangganController::class);

Route::get('/portofolio', [ProfileController::class, 'publicView'])->name('portofolio.public');

Route::prefix('admin')->group(function () {
    // Route Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Route Experience
    Route::resource('experience', ExperienceController::class);

    // Route Skill (Inilah nama route yang dicari: skill.index, skill.store, skill.destroy)
    Route::resource('skill', SkillController::class);
});

Route::resource('user', UserController::class);

use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('auth.logout');

Route::group(['middleware' => ['checkrole:Super Admin']], function () {
   Route::resource('user', UserController::class);
    /** List Route Lainnya */
});
