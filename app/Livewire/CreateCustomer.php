<?php

namespace App\Livewire;

use Livewire\Component;

class CreateCustomer extends Component
{

    public $name;
    public $email;
    public $phone;

    public function save(){
        dd($this->all());
    }
    public function render()
    {
        return view('livewire.create-customer');
    }
}
