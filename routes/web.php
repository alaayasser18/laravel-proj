<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\EmployeeController;


Route::get('/register', [ManagerController::class, 'registerForm'])->name('register');
Route::post('/register', [ManagerController::class, 'register'])->name('register.submit');


Route::get('/login', [ManagerController::class, 'loginForm'])->name('login');
Route::post('/login', [ManagerController::class, 'login'])->name('login.submit');



Route::post('/logout', [ManagerController::class, 'logout'])->name('logout');


Route::get('/home', [ManagerController::class, 'home'])->name('home')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::resource('employees', EmployeeController::class);
});
