<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Forgot Password')]
class ForgotPassword extends Component
{
    public $email;

    public function save()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email|max:255'

        ]);

        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('success', 'Password reset link បានផ្ញើទៅអ៊ីមែលរបស់អ្នករួចហើយ');
            $this->email = '';
        }
    }
    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
