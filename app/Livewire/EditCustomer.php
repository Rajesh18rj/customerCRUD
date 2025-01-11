<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Component;

class EditCustomer extends Component
{
    public $customer;
    public $name;
    public $email;
    public $phone;

    public function mount(Customer $customer){
        $this->customer = $customer;
        $this->name=$customer->name;
        $this->email=$customer->email;
        $this->phone=$customer->phone;
    }
    public function render()
    {
        return view('livewire.edit-customer');
    }

    public function updateCustomer(){
        $validated = $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|',
            'phone' => 'required|',
        ]);

        $this->customer->update($validated);
        session()->flash('success', 'Customer Updated successfully.');
        return $this->redirect('/customers', navigate:true);

    }
}
