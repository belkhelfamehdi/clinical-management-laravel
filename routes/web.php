<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MedicamentController;
use App\Http\Controllers\ChambreController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\DonneurController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\SalaireController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::resource('patients', PatientController::class)->middleware('auth');
Route::resource('employees', EmployeeController::class)->middleware('auth');
Route::resource('medicaments', MedicamentController::class)->middleware('auth');
Route::resource('chambres', ChambreController::class)->middleware('auth');
Route::resource('factures', FactureController::class)->middleware('auth');
Route::resource('donneurs', DonneurController::class)->middleware('auth');
Route::resource('conges', CongeController::class)->middleware('auth');
Route::resource('salaires', SalaireController::class)->middleware('auth');
Route::redirect('salaries', 'salaires');
Route::redirect('leaves', 'conges');
Route::redirect('bloodbank', 'donneurs');
Route::redirect('appointments', 'rendez-vous');
Route::resource('appointments', ConsultationController::class)->except(['show', 'edit', 'update'])->middleware('auth');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
