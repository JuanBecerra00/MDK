<?php

namespace App\Exports;

use App\Models\Provider;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProvidersExportPdf implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public $selecteds = [];
    public $fields = [];
    public $fieldsEs = [];
    public $toExport;
    public function __construct($selecteds, $fieldId, $fieldNit, $fieldName, $fieldPhone, $fieldStatus)
    {
        $this->selecteds = $selecteds;
        $i = 0;
        $lfields = ['Id', 'Nit','Name', 'Phone', 'Status'];
        $lfieldsEs = ['Id', 'Nit', 'Nombre', 'Telefono', 'Estado'];
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
        return Provider::select($this->fields)->whereIn('id', $this->selecteds);
    }
    public function headings(): array
    {
        return [$this->fieldsEs];
    }

}
