<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Component;

class ViewCustomer extends Component
{
    public $customer;
    public function mount(Customer $customer){
        $this->customer = $customer;
    }
    public function render()
    {
        return view('livewire.view-customer');
    }
}
