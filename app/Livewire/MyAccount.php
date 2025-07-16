<?php

namespace App\Livewire;

use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('My Account')]
class MyAccount extends Component
{
    public string $name = '';
    public string $email = '';

    public function mount(): void
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
        }
    }

    public function updateProfile(): void
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user) {
            // Handle case where user is not authenticated
            return;
        }

        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->update($validated);

        // Dispatch an event to notify the navbar to update the name
        $this->dispatch('profile-updated', name: $user->name);

        LivewireAlert::title('បានធ្វើបច្ចុប្បន្នភាពដោយជោគជ័យ')
            ->text('ព័ត៌មានគណនីរបស់អ្នកត្រូវបានធ្វើបច្ចុប្បន្នភាព។')
            ->position('bottom-end')
            ->timer(3000)
            ->success()
            ->toast()
            ->show();
    }

    public function render()
    {
        return view('livewire.my-account');
    }
}
