<?php

namespace App\Http\Livewire;

use App\Models\Provider;
use Livewire\Component;

class ProviderTable extends Component
{
    public function render()
    {
        return view('livewire.provider-table', ['providers' => Provider::all()]);
    }
}
