<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Register extends Component
{
    public $username, $email, $password;
    public function render()
    {
        return view('livewire.auth.register');
    }
}
