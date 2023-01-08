<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public $selecteds = [];
    public $toExport;
    public function __construct($selecteds)
    {
        $this->selecteds = $selecteds;
    }

    public function query()
    {
        return User::whereIn('id', $this->selecteds);
    }
}

