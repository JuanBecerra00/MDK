<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;

class CustomerTable extends Component
{
    public function render()
    {
        return view('livewire.customer-table', ['customers' => Customer::all()]);
    }
}
