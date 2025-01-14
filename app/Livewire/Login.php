<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public function render()
    {
        return view('livewire.login');
    }

    public function loginUser(Request $request){
        $validated = $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        //if the password matches email we are allow the user to login
        if(Auth::attempt($validated)){
            $request->session()->regenerate();

            return $this->redirect('/customers', navigate: true);
        }
        //if the password did not match to that email
        $this->addError('email', 'The Password provided is incorrect.');
    }
}
