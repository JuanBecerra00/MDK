<?php

namespace App\Http\Livewire;

use App\Exports\VehiclesExportPdf;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Report;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Livewire\Component;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class VehicleTable extends Component
{
    use WithPagination;
    public $showingVehicleModal = false;

    public $vehiclesRendered;
    public $idVehicle;
    public $customerInput='';
    public $Npt='';
    public $customer_id;
    public $plate;
    public $model;
    public $status;
    public $regstatus="";
    public $isEditMode = false;
    public $isReportsMode = false;
    public $customers;
    public $selectedCustomer;
    public $reports;
    public $reportsValidate;
    public $isHowToSearchMode = false;
    public $vehicle;

    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $paginate = '5';
    public $fieldId = true;
    public $fieldCustomer_id = true;
    public $fieldPlate = true;
    public $fieldModel = true;
    public $fieldStatus = true;
    public $validateCustomer_id;
    public $isSelectedAll = 0;
    public $filter = 1;
    public $filterType = '';
    public $fontSize = 16;
    public $selecteds = [];
    public $fields = ['fieldId', 'fieldCustomer_id','fieldPlate', 'fieldModel', 'fieldStatus'];
    public $fieldsExport = [];

    public $exportData;
    public $encryption;
    public $test = 0;
    public $report = '';
    public $report_ProductsSelectedArr = [];
    public $report_ProductsAmmountArr = [];
    public $report_ProductsAmmountArrFinal;
    public $report_ProceduresArr = [];
    public $report_ProceduresArrFinal;
    public $oilFilterTypeArr;
    public $report_ProductsTotal;
    public $report_ProceduresTotal;
    public $pdfSelecteds = 0;
    public $pdfFields = 0;
    public $pdfSelectedsArray = [];

    public $reportSelected='';
    public $search;
    protected $queryString = ['search'];
    public function addToSelecteds($rowId)
    {
        if(in_array($rowId, $this->selecteds)){
            $this->selecteds = \array_diff($this->selecteds, [$rowId]);
        }else{
            array_push($this->selecteds, $rowId);
        }
    }

    public function selectAll($value)
    {
        $vehicles = Vehicle::where('plate', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('model', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('id', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('customer_id', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orderBy($this->sortField, $this->sortDirection)->paginate($this->paginate);

        if($this->isSelectedAll!=0){
            foreach($vehicles as $vehicle){
                if(in_array($vehicle->id, $this->selecteds)==false){
                    array_push($this->selecteds, $vehicle->id);
                }
            }
        }else{
            foreach($vehicles as $vehicle){
                $this->selecteds = \array_diff($this->selecteds, [$vehicle->id]);
            }
        }
    }

    public function deselectAll()
    {
        $this->selecteds = [];
    }
    public function showVehicleModal()
    {
        $this->customer_id = '';
        $this->customerInput = '';
        $this->plate = '';
        $this->model = '';
        $this->status = '';
        $this->isEditMode = false;
        $this->isReportsMode = false;
        $this->isHowToSearchMode = false;
        $this->showingVehicleModal = true;
    }

    public function modalRegFormReset()
    {
        $this->customer_id = '';
        $this->customerInput = '';
        $this->plate = '';
        $this->model = '';
        $this->status = '';
    }
    public function searchUser($id)
    {
        $u = User::find($id);
        return $u->name;
    }
    public function modalEditFormReset()
    {
        $this->customer_id = $this->vehicle->customer_id;
        $this->plate = $this->vehicle->plate;
        $this->model = $this->vehicle->model;
        $this->status = $this->vehicle->status;
        $c = Customer::find($this->vehicle->customer_id);
        $this->customerInput = $c->name;
    }

    public function hideModal()
    {
        $this->showingVehicleModal = false;
    }

    public function sortBy($field)
    {
        if ($this->sortField == $field){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function changePaginate($number)
    {
        $this->paginate = $number;
    }

    public function filter($value)
    {
        $this->filter = $value;
    }

    public function filterType($value)
    {
        $this->filterType = $value;
    }

    public function changeField($field)
    {
        if ($this->$field == true){
            $this->$field = false;
        } else {
            $this->$field = true;
        }
        if(in_array($field, $this->fields)){
            $this->fields = \array_diff($this->fields, [$field]);
        }else{
            array_push($this->fields, $field);
        }
    }


    protected $validationAttributes = [

        'customer_id' => 'id del cliente',
        'plate' => 'Placa',
        'model' => 'Modelo',
    ];
    protected $messages = [
        'customer_id.same' => 'La id del cliente no valida.',
        'plate.unique' => 'Numero de placa ya registrado.',
        'model.unique' => 'Modelo ya registrado.',
        'plate.max' => 'La placa no puede tener mas de :max caracteres.',
    ];
    public function saveVehicle()
    {

        $this->validate([
            'customer_id' => 'required',
            'plate' => 'required',
            'model' => 'required',
        ]);
        $vehicle = new Vehicle();
        $vehicle->plate = $this->plate;
        $vehicle->customer_id = $this->customer_id;
        $vehicle->model = $this->model;
        $vehicle->reports = 0;
        $regstatus=$this->status;
        if($this->status==""){
            $this->status="1";
        };
        $vehicle->status = $this->status;
        $vehicle->save();
        $this->showingVehicleModal = false;
    }

    public function showEditVehicleModal($id)
    {
        $this->vehicle = Vehicle::findOrfail($id);
        $this->idVehicle = $this->vehicle->id;
        $this->customer_id = $this->vehicle->customer_id;
        $c = Customer::find($this->vehicle->customer_id);
        $this->customerInput = $c->name;
        $this->plate = $this->vehicle->plate;
        $this->model = $this->vehicle->model;
        $this->status = $this->vehicle->status;
        $this->isHowToSearchMode = false;
        $this->isEditMode = true;
        $this->isReportsMode = false;
        $this->showingVehicleModal = true;
    }

    public function showReportsVehicleModal($id)
    {
        $this->report = '';
        $this->Npt = '';
        $this->reports = Report::where('vehicle_id', $id)
        ->orderBy('id')
        ->get();
        
        $this->isEditMode = false;
        $this->isReportsMode = true;
        $this->isHowToSearchMode = false;
        $this->showingVehicleModal = true;
    }
    public function setReport($id)
    {
        $this->report = Report::where('id', $id)
        ->orderBy('id')
        ->take(1)
        ->get();

        foreach($this->report as $r){

            $this->oilFilterTypeArr = explode(",", $r->oilFilterType);

            $this->report_ProductsSelectedArr = explode(",", $r->productsSelected);
            $removed = array_shift($this->report_ProductsSelectedArr);

            $this->report_ProductsAmmount = $r->productsAmmount;
            $this->report_ProductsAmmountArr = explode("|", $this->report_ProductsAmmount);
            $removed = array_shift($this->report_ProductsAmmountArr);
            $this->report_ProductsAmmountArrFinal = [];
            foreach($this->report_ProductsAmmountArr as $a){
                array_push($this->report_ProductsAmmountArrFinal, explode(",", $a));
            }


            $this->report_Procedures = $r->procedures;
            $this->report_ProceduresArr = explode("|", $this->report_Procedures);
            $this->report_ProceduresArrFinal = [];
            foreach($this->report_ProceduresArr as $a){
                array_push($this->report_ProceduresArrFinal, explode(",", $a));
            }
            $removed = array_pop($this->report_ProceduresArrFinal);
            
        }
        $this->report_ProductsTotal =0;
        foreach ($this->report_ProductsAmmountArrFinal as $product) {
            $this->report_ProductsTotal += $product[2];
        }
        $i = 1;
        $this->report_ProceduresTotal =0;
        foreach ($this->report_ProceduresArrFinal as $procedure) {
            $this->report_ProceduresTotal += $procedure[1];
            $i++;
        }
        
        
    }
    public function setReportNpt($value){
        $this->Npt = $value;
    }
    public function searchProduct($id, $col)
    {
        $product = Product::find($id);
        return $product->$col;
    }

    public function searchCustomer($Id)
    {
        $customer = Customer::findOrfail($Id);
        return $customer->name;
    }

    public function searchVehicle($Id)
    {
        $vehicle = Vehicle::findOrfail($Id);
        return $vehicle->plate;
    }

    public function showHowToSearchModal()
    {
        $this->isHowToSearchMode = true;
        $this->isEditMode = false;
        $this->isReportsMode = false;
        $this->showingVehicleModal = true;
    }
    public function updateVehicle(){
        $this->vehicle->update([
            'customer_id' => $this->customer_id,
            'plate' => $this->plate,
            'model' => $this->model,
            'status' => $this->status,
        ]);

        $this->showingVehicleModal=false;
    }
    public function delete($id): array
    {
        $vehicle = Vehicle::find($id);
        if ($vehicle->status == "0"){
            $vehicle->status = "1";
        }elseif ($vehicle->status == "1"){
            $vehicle->status = "0";
        }
        return [

            $vehicle->save()
        ];
    }
    public function fontSizeBigger()
    {
        $this->fontSize+=1;
    }

    public function fontSizeSmaller()
    {
        $this->fontSize-=1;
    }
    public function exportExcel()
    {
        $customers = Customer::all();
        return Excel::download(new VehiclesExportPdf($this->selecteds, $this->fieldId, $this->fieldCustomer_id, $this->fieldPlate, $this->fieldModel, $this->fieldStatus, $customers), 'vehicles.xlsx');
    }
    public function exportCsv()
    {
        $customers = Customer::all();
        return Excel::download(new VehiclesExportPdf($this->selecteds , $this->fieldId, $this->fieldCustomer_id, $this->fieldPlate, $this->fieldModel, $this->fieldStatus, $customers), 'vehicles.csv');
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function loadSelecteds($selecteds)
    {
        return view("exports.pdf",['selecteds' => $selecteds]);

    }

    public function setCustomer($id)
    {
        $this->customer_id = $id;
        
        $c = Customer::find($id);
        $this->customerInput = $c->name;

    }
    public function pdf($exportData)
    {
        $vehicles = Vehicle::all();
        $pdf = PDF::loadView('exports.vehiclePdf', compact('vehicles'),['exportData' => $exportData]);
        return $pdf->stream('vehicle.pdf');

    }
    public function render()
    {
        $this->customers = Customer::all();
        $this->reportsValidate = Report::where('vehicle_id', -1)->orderBy('id')->get();
        $this->pdfFields = implode(',',$this->fields);
        $this->pdfSelecteds = implode(',',$this->selecteds);
        $this->exportData=$this->pdfSelecteds.','.$this->pdfFields;
        $this->isSelectedAll=0;
        $this->encryption = openssl_encrypt($this->exportData, "AES-128-CTR",
            "34567890odxcvbnko8765", 0, '1234567891011121');
        $this->encryption = str_replace('/', 'ñ', $this->encryption);
        $vehicles = Vehicle::where('plate', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('model', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('id', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('customer_id', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orderBy($this->sortField, $this->sortDirection)->paginate($this->paginate);
        foreach($vehicles as $vehicle){
            if(in_array($vehicle->id, $this->selecteds)){
            }else{
                $this->isSelectedAll+=1;
            }
        }
        return view('livewire.vehicle-table', ['vehicles' => $vehicles]);

    }
}