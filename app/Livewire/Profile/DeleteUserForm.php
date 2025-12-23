<?php

namespace App\Livewire\Profile;

use Auth;
use Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class DeleteUserForm extends Component
{
    public string $password = '';

    public function deleteUser()
    {
        $this->validate([
            'password' => ['required'],
        ]);

        if (! Hash::check($this->password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'password' => __('The provided password does not match our records.'),
            ]);
        }

        $user = Auth::user();

        Auth::logout();

        $user->delete();

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.profile.delete-user-form');
    }
}
