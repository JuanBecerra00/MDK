<?php

namespace App\Http\Livewire;

use App\Models\Report;
use Livewire\Component;

class ReportTable extends Component
{
    public function render()
    {
        return view('livewire.report-table', ['reports' => Report::all()]);
    }
}
