<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::any('/login', [AuthController::class, 'login'])->name('login');
Route::livewire('/', 'pages::portal')->name('portal');

Route::middleware(['auth'])->group(function () {
    Route::livewire('/admin', 'pages::admin.dashboard')->name('admin');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
