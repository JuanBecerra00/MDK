<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Ramsey\Uuid\Nonstandard\Fields;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public $selecteds = [];
    public $fields = [];
    public $fieldsEs = [];
    public $toExport;
    public function __construct($selecteds, $fieldId, $fieldProviders_id, $fieldBills_id, $fieldName, $fieldAmmount, $fieldPrice, $fieldDate, $fieldType, $fieldStatus)
    {
        $this->selecteds = $selecteds;
        $i = 0;
        $lfields = ['Id', 'Providers_id', 'Bills_id', 'Name', 'Ammount', 'Price', 'Date', 'Type', 'Status'];
        $lfieldsEs = ['Id', 'Id del proveeedor', 'Id de la factura', 'Nombre', 'Cantidad', 'Precio', 'Fecha', 'Tipo', 'Estado'];
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
        return Product::select($this->fields)->whereIn('id', $this->selecteds);
    }
    public function headings(): array
    {
        return [$this->fieldsEs];
    }

}
