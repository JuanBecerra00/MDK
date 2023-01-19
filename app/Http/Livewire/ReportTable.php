<?php

namespace App\Http\Livewire;

use App\Exports\ReportsExportPdf;
use App\Models\Customer;
use App\Models\Vehicle;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Livewire\Component;
use App\Models\Report;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ReportTable extends Component
{
    use WithPagination;
    public $showingReportModal = false;

    public $reportsRendered;
    public $idReport;
    public $customer_id;
    public $vehicle_id;
    public $date;
    public $status;
    public $regstatus="";
    public $isEditMode = false;
    public $isHowToSearchMode = false;
    public $report;

    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $paginate = '5';
    public $fieldId = true;
    public $fieldCustomer_id = true;
    public $fieldVehicle_id = true;
    public $fieldDate = true;
    public $fieldStatus = true;
    public $validateCustomer_id;
    public $isSelectedAll = 0;
    public $filter = 1;
    public $filterType = '';
    public $fontSize = 16;
    public $selecteds = [];
    public $fields = ['fieldId', 'fieldCustomer_id','fieldVehicle_id', 'fieldDate', 'fieldStatus'];
    public $fieldsExport = [];

    public $exportData;
    public $encryption;
    public $test = 0;
    public $pdfSelecteds = 0;
    public $pdfFields = 0;
    public $pdfSelectedsArray = [];

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

    public function selectAll($value)
    {
        $reports = Report::where('vehicle_id', 'like', '%'.$this->search.'%')
            ->orwhere('date', 'like', '%'.$this->search.'%')
            ->orwhere('id', 'like', '%'.$this->search.'%')
            ->orwhere('customer_id', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortField, $this->sortDirection)->paginate($this->paginate);

        if($this->isSelectedAll!=0){
            foreach($reports as $report){
                if(in_array($report->id, $this->selecteds)==false){
                    array_push($this->selecteds, $report->id);
                }
            }
        }else{
            foreach($reports as $report){
                $this->selecteds = \array_diff($this->selecteds, [$report->id]);
            }
        }
    }

    public function deselectAll()
    {
        $this->selecteds = [];
    }
    public function showReportModal()
    {
        $this->customer_id = '';
        $this->vehicle_id = '';
        $this->date = '';
        $this->status = '';
        $this->isEditMode = false;
        $this->isHowToSearchMode = false;
        $this->showingReportModal = true;
    }

    public function modalRegFormReset()
    {
        $this->customer_id = '';
        $this->vehicle_id = '';
        $this->date = '';
        $this->status = '';
    }

    public function modalEditFormReset()
    {
        $this->customer_id = $this->report->customer_id;
        $this->vehicle_id = $this->report->vehicle_id;
        $this->date = $this->report->date;
        $this->status = $this->report->status;
    }

    public function hideModal()
    {
        $this->showingReportModal = false;
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
        'vehicle_id' => 'Placa',
        'date' => 'Modelo',
    ];
    protected $messages = [
        'customer_id.same' => 'La id del cliente no valida.',
        'vehicle_id.unique' => 'Numero de placa ya registrado.',
        'date.unique' => 'Modelo ya registrado.',
        'vehicle_id.max' => 'La placa no puede tener mas de :max caracteres.',
    ];
    public function saveReport()
    {

        $this->validate([
            'customer_id' => 'required',
            'vehicle_id' => 'required',
            'date' => 'required',
        ]);
        $report = new Report();
        $report->vehicle_id = $this->vehicle_id;
        $report->customer_id = $this->customer_id;
        $report->date = $this->date;
        $regstatus=$this->status;
        if($this->status==""){
            $this->status="1";
        };
        $report->status = $this->status;
        $report->save();
        $this->showingReportModal = false;
    }

    public function showEditReportModal($id)
    {
        $this->report = Report::findOrfail($id);
        $this->idReport = $this->report->id;
        $this->customer_id = $this->report->customer_id;
        $this->vehicle_id = $this->report->vehicle_id;
        $this->date = $this->report->date;
        $this->status = $this->report->status;
        $this->isHowToSearchMode = false;
        $this->isEditMode = true;
        $this->showingReportModal = true;
    }

    public function showHowToSearchModal()
    {
        $this->isHowToSearchMode = true;
        $this->isEditMode = false;
        $this->showingReportModal = true;
    }
    public function updateReport(){
        $this->report->update([
            'customer_id' => $this->customer_id,
            'vehicle_id' => $this->vehicle_id,
            'date' => $this->date,
            'status' => $this->status,
        ]);

        $this->showingReportModal=false;
    }
    public function delete($id): array
    {
        $report = Report::find($id);
        if ($report->status == "0"){
            $report->status = "1";
        }elseif ($report->status == "1"){
            $report->status = "0";
        }
        return [

            $report->save()
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
        return Excel::download(new ReportsExportPdf($this->selecteds, $this->fieldId, $this->fieldCustomer_id, $this->fieldVehicle_id, $this->fieldDate, $this->fieldStatus), 'reports.xlsx');
    }
    public function exportCsv()
    {
        return Excel::download(new ReportsExportPdf($this->selecteds , $this->fieldId, $this->fieldCustomer_id, $this->fieldVehicle_id, $this->fieldDate, $this->fieldStatus), 'reports.csv');
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function loadSelecteds($selecteds)
    {
        return view("exports.pdf",['selecteds' => $selecteds]);

    }
    public function pdf($exportData)
    {
        $reports = Report::all();
        $pdf = PDF::loadView('exports.reportPdf', compact('reports'),['exportData' => $exportData]);
        return $pdf->stream('report.pdf');

    }
    public function render()
    {
        $this->pdfFields = implode(',',$this->fields);
        $this->pdfSelecteds = implode(',',$this->selecteds);
        $this->exportData=$this->pdfSelecteds.','.$this->pdfFields;
        $this->isSelectedAll=0;
        $this->encryption = openssl_encrypt($this->exportData, "AES-128-CTR",
            "34567890odxcvbnko8765", 0, '1234567891011121');
        $this->encryption = str_replace('/', 'ñ', $this->encryption);
        $reports = Report::where('vehicle_id', 'like', '%'.$this->search.'%')
            ->orwhere('id', 'like', '%'.$this->search.'%')
            ->orwhere('customer_id', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortField, $this->sortDirection)->paginate($this->paginate);
        foreach($reports as $report){
            if(in_array($report->id, $this->selecteds)){
            }else{
                $this->isSelectedAll+=1;
            }
        }
        return view('livewire.report-table', ['reports' => $reports]);

    }
}