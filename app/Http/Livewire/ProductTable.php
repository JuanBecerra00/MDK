<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductTable extends Component
{
    public function render()
    {
        return view('livewire.product-table', ['products' => Product::all()]);
    }
}
