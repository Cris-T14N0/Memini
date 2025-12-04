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

Route::get('/setup/{key}', function($key){
    if ($key !== env('SETUP_KEY')) abort(403); // Security check
    \Artisan::call('migrate', ['--force' => true]); // Run migrations
    \Artisan::call('db:seed', ['--force' => true]);   // Run seeders
    return 'Setup complete!';
});


require __DIR__.'/auth.php';
