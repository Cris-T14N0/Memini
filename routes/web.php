<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'index');

// Route Dashboard
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route Dashboard Pastas
Route::view('livewire.pastas.pastas-dashboard', 'livewire.pastas.pastas-dashboard')
    ->middleware(['auth', 'verified'])
    ->name('pastas-dashboard');

// Route Dashboard Projetos
Route::view('livewire.projetos.projetos-dashboard', 'livewire.projetos.projetos-dashboard')
    ->middleware(['auth', 'verified'])
    ->name('projetos-dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
