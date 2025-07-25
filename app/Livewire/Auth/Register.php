<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Register')]
class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $phone;

    // register user
    public function save()
    {
        $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'phone' => 'required|unique:users|max:20',
            'password' => 'required|min:6|max:255',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => Hash::make($this->password),
            'email_verified_at' => now(),
        ]);

        // login user
        Auth::login($user);

        //redirect to homepage
        return redirect()->intended();
    }
    public function render()
    {
        return view('livewire.auth.register');
    }
}
