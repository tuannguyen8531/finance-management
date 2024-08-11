<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', \App\Http\Livewire\Auth\Login::class)->name('login');
Route::get('/logout', [\App\Http\Livewire\Auth\Login::class, 'logout'])->name('logout');

Route::middleware('checklogin')->group(function () {
    Route::get('/', \App\Http\Livewire\DashboardLive::class)->name('dashboard');
    Route::get('/user', \App\Http\Livewire\User\UserLive::class)->name('user');
});
