<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Component;

class CreateCustomer extends Component
{

    public $name= '';
    public $email= '';
    public $phone= '';

    public function save(){
        //validate
        $validated= $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|unique:customers',
        ]);

        //create
        Customer::create($validated);
    }
    public function render()
    {
        return view('livewire.create-customer');
    }
}
