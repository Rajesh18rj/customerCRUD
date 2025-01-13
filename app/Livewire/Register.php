<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public function render()
    {
        return view('livewire.register');
    }

    public function storeUser(){
        $validated = $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        //after validate the User we are going to save that user
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        // after save the user , we need to login that user
        Auth::login($user);

        session()->flash('success', 'Registration successful!');

        //after login we need to redirect to the customers
        return $this->redirect('/customers', navigate:true);
    }
}
