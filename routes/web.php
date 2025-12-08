<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'index');

// Route Dashboard
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route Dashboard Pastas
Route::view('folders.folders-dashboard', 'folders.folders-dashboard')
    ->middleware(['auth', 'verified'])
    ->name('pastas-dashboard');

// Route Dashboard Projetos
Route::view('projects.projects-dashboard', 'projects.projects-dashboard')
    ->middleware(['auth', 'verified'])
    ->name('projects-dashboard');

// Route Dashboard Álbuns
Route::view('livewire.albuns.albuns-dashboard', 'livewire.albuns.albuns-dashboard')
    ->middleware(['auth', 'verified'])
    ->name('albuns-dashboard');

// Route Dashboard Álbuns
Route::view('livewire.albuns.albuns-media-dashboard', 'livewire.albuns.albuns-media-dashboard')
    ->middleware(['auth', 'verified'])
    ->name('media-dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
