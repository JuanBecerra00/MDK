<?php

namespace App\Exports;

use App\Models\Vehicle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Ramsey\Uuid\Nonstandard\Fields;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VehiclesExportPdf implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public $selecteds = [];
    public $fields = [];
    public $fieldsEs = [];
    public $toExport;
    public function __construct($selecteds, $fieldId, $fieldCustomer_id, $fieldPlate, $fieldModel, $fieldStatus)
    {
        $this->selecteds = $selecteds;
        $i = 0;
        $lfields = ['Id', 'Customer_id', 'Plate', 'Model', 'Status'];
        $lfieldsEs = ['Id', 'Id del cliente','Placa', 'Modelo','Estado'];
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
        return Vehicle::select($this->fields)->whereIn('id', $this->selecteds);
    }
    public function headings(): array
    {
        return [$this->fieldsEs];
    }

}