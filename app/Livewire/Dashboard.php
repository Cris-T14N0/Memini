<?php

namespace App\Livewire;

use App\Models\Album;
use App\Models\Folder;
use App\Models\Media;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $stats = [];

    public function mount()
    {
        $userId = Auth::id();

        // Count folders owned by user
        $foldersCount = Folder::where('user_id', $userId)->count();

        // Count projects owned by user + projects shared with user
        $ownedProjectsCount = Project::where('user_id', $userId)->count();
        $sharedProjectsCount = Project::whereHas('users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();
        $totalProjects = $ownedProjectsCount + $sharedProjectsCount;

        // Count albums from owned projects + albums from shared projects
        $ownedAlbumsCount = Album::whereHas('project', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();

        $sharedAlbumsCount = Album::whereHas('project.users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();
        $totalAlbums = $ownedAlbumsCount + $sharedAlbumsCount;

        // Count media from all accessible albums
        $totalMedia = Media::whereHas('album.project', function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->orWhereHas('users', function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                });
        })->count();

        $this->stats = [
            'folders' => $foldersCount,
            'projects' => $totalProjects,
            'albums' => $totalAlbums,
            'media' => $totalMedia,
        ];
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}