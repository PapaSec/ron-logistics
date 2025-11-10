<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.guest')]
#[Title('Register - Ron Logistics')]
class Register extends Component
{
    public $name, $email, $password;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string|min:6'
    ];

    public function register() 
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Optional: Login the user after registration
        // auth()->login($user);

        // Redirect to dashboard or home page
        return redirect()->to('/dashboard');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}