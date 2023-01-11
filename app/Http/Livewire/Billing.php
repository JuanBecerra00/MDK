<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Vehicle;
use Livewire\Component;

class Billing extends Component
{
    public function render()
    {
        return view('livewire.billing', ['users' => User::all()],['vehicles' => Vehicle::all()]);
    }
}
