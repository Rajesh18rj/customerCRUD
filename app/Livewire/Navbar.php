<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{

    public function logout(Request $request){
       Auth::logout();
       $request->session()->invalidate();
       $request->session()->regenerateToken();
       return $this->redirect('login', navigate: true);
    }

    public function render()
    {
        return view('livewire.navbar');
    }


}
