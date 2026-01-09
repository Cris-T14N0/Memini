<?php

use App\Http\Controllers\InvitationController;
use App\Livewire\Shared\ShowSharedAlbum;
use App\Models\Album;
use App\Models\Folder;
use App\Models\Project;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::view('/', 'index')->name('home');

// Shared Album Route (PUBLIC - no auth required)
Route::get('/shared/{token}', function($token) {
    return view('shared.album', compact('token'));
})->name('shared.show');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::view('dashboard', 'dashboard')->name('dashboard');
    
    // Profile
    Route::view('profile', 'profile')->name('profile');
    
    /*
    |--------------------------------------------------------------------------
    | Folders Routes
    |--------------------------------------------------------------------------
    */
    
    Route::view('folders.folders-dashboard', 'folders.folders-dashboard')
        ->name('folders-dashboard');
    
    Route::get('/folders/{folder}', function (Folder $folder) {
        return view('folders.projects-on-folders-dashboard', compact('folder'));
    })->name('folders.show');
    
    /*
    |--------------------------------------------------------------------------
    | Projects Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/invitations/accept/{token}', [InvitationController::class, 'accept'])
    ->name('invitations.accept');
    
    Route::view('projects.projects-dashboard', 'projects.projects-dashboard')
        ->name('projects-dashboard');
    
    Route::get('/projects/{project}/albums', function (Project $project) {
        // Verify user has access to the project
        if ($project->user_id !== auth()->id() && 
            !$project->users()->where('user_id', auth()->id())->exists()) {
            abort(403, 'Não autorizado');
        }
        
        return view('albums.albums-on-project', ['projectId' => $project->id]);
    })->name('projects.albums');
    
    /*
    |--------------------------------------------------------------------------
    | Albums Routes
    |--------------------------------------------------------------------------
    */
    
    Route::view('albums.albums-on-project', 'albums.albums-on-project')
        ->name('albums-dashboard');
    
    Route::get('/albums/{album}', function (Album $album) {
        // Check if user has access to this album's project
        $project = $album->project;
        $userId = auth()->id();
        
        // Check if user is owner or collaborator
        $isOwner = $project->user_id === $userId;
        $isCollaborator = $project->users()->where('user_id', $userId)->exists();
        
        if (!$isOwner && !$isCollaborator) {
            abort(403, 'Não tens acesso a este álbum.');
        }
        
        return view('media.media-on-albums', ['album' => $album]);
    })->name('albums.show');
    
    /*
    |--------------------------------------------------------------------------
    | Media Routes
    |--------------------------------------------------------------------------
    */
    
    Route::view('livewire.albuns.albuns-media-dashboard', 'livewire.albuns.albuns-media-dashboard')
        ->name('media-dashboard');
});