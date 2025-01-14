<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class Customers extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search='';
//    public function mount(){
//    }

    public function deleteCustomer(Customer $customer){
        $customer->delete();
        session()->flash('success', 'Customer Deleted successfully.');
        return $this->redirect('/customers', navigate:true);
    }

    public function render()
    {
        if(! $this->search){
            $customers = Customer::paginate(2);
        }
        else{
            $customers = Customer::where('name', 'like', '%'.$this->search.'%')->paginate(2);
        }

        return view('livewire.customers',[
            'customers' => $customers,
        ]);
    }
}
