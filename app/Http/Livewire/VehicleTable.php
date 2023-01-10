<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;

class VehicleTable extends Component
{
    public function render()
    {
        return view('livewire.vehicle-table', ['vehicles' => Vehicle::all()]);
    }
}
