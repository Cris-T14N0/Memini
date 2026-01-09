<?php

namespace App\Livewire\Profile;

use Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ChangeProfilePicture extends Component
{
    use WithFileUploads;

    public $photo = null;

    protected $messages = [
        'photo.required' => 'Por favor, selecione uma foto',
        'photo.image' => 'De certeza que colocou uma imagem?',
        'photo.mimes' => 'Este tipo de imagem não é suportada.',
        'photo.max' => 'A imagem não pode ter mais que 5 megabytes',
    ];

    public function updateProfilePhoto(): void
    {
        $this->validate([
            'photo' => 'required|image|mimes:jpeg,png,gif,jpg,webp|max:5120',
        ]);

        $user = Auth::user();
        $userId = $user->id;

        // Delete old photo if exists
        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        // Get the file extension
        $extension = $this->photo->getClientOriginalExtension();
        
        // Create filename: {user_id}_pfp.{extension}
        $filename = "{$userId}_pfp.{$extension}";

        // Store in storage/app/public/{user_id}/
        $path = $this->photo->storeAs("{$userId}", $filename, 'public');

        // Save path to database
        $user->update(['profile_photo' => $path]);

        $this->photo = null;
        $this->dispatch('profile-photo-updated');
        session()->flash('success', 'Foto de perfil atualizada com sucesso!');
        redirect('profile');
    }

    public function deleteProfilePhoto(): void
    {
        $user = Auth::user();

        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
            $user->update(['profile_photo' => null]);
        }

        $this->photo = null;
        $this->dispatch('profile-photo-deleted');
        session()->flash('success', 'Foto de perfil removida com sucesso!');
    }

    public function render()
    {
        return view('livewire.profile.change-profile-picture');
    }
}