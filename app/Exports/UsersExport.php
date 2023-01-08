<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Ramsey\Uuid\Nonstandard\Fields;

class UsersExport implements FromQuery
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public $selecteds = [];
    public $fields = [];
    public $toExport;
    public function __construct($selecteds, $fieldId, $fieldType, $fieldCc, $fieldName, $fieldJob, $fieldEmail, $fieldPhone, $fieldQuestion, $fieldAnswer, $fieldStatus)
    {
        $this->selecteds = $selecteds;
        $lfields = ['Id', 'Type', 'Cc', 'Name', 'Job', 'Email', 'Phone', 'Question', 'Answer', 'Status'];
        foreach ($lfields as $lfield) {
            $checkfield = 'field'.$lfield;
            if ($$checkfield == true) {
                array_push($this->fields, $lfield);
            }
        }
    }
    public function query()
    {
        return User::select($this->fields)->whereIn('id', $this->selecteds);
    }

}