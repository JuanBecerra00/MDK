<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Ramsey\Uuid\Nonstandard\Fields;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExportPdf implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public $selecteds = [];
    public $fields = [];
    public $fieldsEs = [];
    public $toExport;
    public function __construct($selecteds, $fieldId, $fieldType, $fieldCc, $fieldName, $fieldDepartment_id, $fieldCity_id, $fieldEmail, $fieldPhone, $fieldStatus)
    {
        $this->selecteds = $selecteds;
        $i = 0;
        $lfields = ['Id', 'Type', 'Cc', 'Name', 'Department_id', 'City_id', 'Email', 'Phone', 'Status'];
        $lfieldsEs = ['Id', 'Tipo de documento', 'Numero de documento', 'Nombre', 'Departamento', 'Ciudad', 'Correo', 'Telefono', 'Estado'];
        foreach ($lfields as $lfield) {
            $checkfield = 'field'.$lfield;
            if ($$checkfield == true) {
                array_push($this->fields, $lfield);
                array_push($this->fieldsEs, $lfieldsEs[$i]);
            }
            $i++;
        }
    }
    public function query()
    {
        return Customer::select($this->fields)->whereIn('id', $this->selecteds);
    }
    public function headings(): array
    {
        return [$this->fieldsEs];
    }

}