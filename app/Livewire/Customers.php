<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Component;

class Customers extends Component
{
//    public $customers=[];
//
//    public function mount(){
//        $this->customers=Customer::all();
//    }
    public function render()
    {
        return view('livewire.customers',[
            'customers' => Customer::all()
        ]);
    }
}
