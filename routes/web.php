<?php

use App\Http\Controllers\InvitationController;
use App\Models\Folder;
use App\Models\Project;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index');

Route::get('/invitations/accept/{token}', [InvitationController::class, 'accept']);


// Route Dashboard
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route Dashboard Pastas
Route::view('folders.folders-dashboard', 'folders.folders-dashboard')
    ->middleware(['auth', 'verified'])
    ->name('folders-dashboard');

Route::get('/folders/{folder}', function (Folder $folder) {
    return view('folders.projects-on-folders-dashboard', compact('folder'));})
    ->middleware(['auth', 'verified'])
    ->name('folders.show');


// Route Dashboard Projetos
Route::view('projects.projects-dashboard', 'projects.projects-dashboard')
    ->middleware(['auth', 'verified'])
    ->name('projects-dashboard');

// Route Dashboard Álbuns
Route::view('albums.albums-on-project', 'albums.albums-on-project')
    ->middleware(['auth', 'verified'])
    ->name('albums-dashboard');

// Route Dashboard Álbuns
Route::view('livewire.albuns.albuns-media-dashboard', 'livewire.albuns.albuns-media-dashboard')
    ->middleware(['auth', 'verified'])
    ->name('media-dashboard');

Route::get('/projects/{project}/albums', function (Project $project) {
    // Verify user has access to the project
    if ($project->user_id !== auth()->id() && 
        !$project->users()->where('user_id', auth()->id())->exists()) {
        abort(403, 'Unauthorized');
    }
    
    return view('albums.albums-on-project', ['projectId' => $project->id]);
})->middleware(['auth', 'verified'])->name('projects.albums');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
