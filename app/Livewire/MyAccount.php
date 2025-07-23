<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('My Account - YDLPhoneShop')]
class MyAccount extends Component
{
    public $name;
    public $email;
    public $phone;

    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
    }

    public function updateProfile()
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
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

    public function changePassword()
    {
        $this->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('The provided password does not match your current password.');
                }
            }],
            'new_password' => 'required|min:8|confirmed',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->current_password = '';
        $this->new_password = '';
        $this->new_password_confirmation = '';

        LivewireAlert::title('ពាក្យសម្ងាត់ត្រូវបានផ្លាស់ប្តូរ')
            ->text('ពាក្យសម្ងាត់របស់អ្នកត្រូវបានផ្លាស់ប្តូរដោយជោគជ័យ។')
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
