<?php

namespace App\Http\Livewire;

use App\Exports\ProvidersExportPdf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Livewire\Component;
use App\Models\Provider;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ProviderTable extends Component
{
    use WithPagination;
    public $showingProviderModal = false;

    public $providersRendered;
    public $idProvider;
    public $nit;
    public $name;
    public $phone;
    public $status;
    public $regstatus="";
    public $isEditMode = false;
    public $isHowToSearchMode = false;
    public $provider;

    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $paginate = '5';
    public $fieldId = true;
    public $fieldNit = true;
    public $fieldName = true;
    public $fieldPhone = true;
    public $fieldStatus = true;
    public $isSelectedAll = 0;
    public $filter = 1;
    public $fontSize = 16;
    public $selecteds = [];
    public $fields = ['fieldId', 'fieldNit', 'fieldName', 'fieldPhone', 'fieldStatus'];
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

    public function selectAll($value)
    {
        $providers = Provider::where('name', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('phone', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('id', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('nit', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orderBy($this->sortField, $this->sortDirection)->paginate($this->paginate);;

        if($this->isSelectedAll!=0){
            foreach($providers as $provider){
                if(in_array($provider->id, $this->selecteds)==false){
                    array_push($this->selecteds, $provider->id);
                }
            }
        }else{
            foreach($providers as $provider){
                $this->selecteds = \array_diff($this->selecteds, [$provider->id]);
            }
        }
    }

    public function deselectAll()
    {
        $this->selecteds = [];
    }
    public function showProviderModal()
    {
        $this->nit = '';
        $this->name = '';
        $this->phone = '';
        $this->status = '';
        $this->isEditMode = false;
        $this->isHowToSearchMode = false;
        $this->showingProviderModal = true;
    }

    public function modalRegFormReset()
    {
        $this->nit = '';
        $this->name = '';
        $this->phone = '';
        $this->status = '';
    }

    public function modalEditFormReset()
    {

        $this->nit = "";
        $this->name = "";
        $this->phone = "";
        $this->status = "";
    }

    public function hideModal()
    {
        $this->showingProviderModal = false;
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
        'nit' => 'Nit',
        'name' => 'Nombre',
        'phone' => 'Telefono',
    ];
    protected $messages = [
        'nit.unique' => 'Numero de documento ya registrado.',
        'phone.unique' => 'Numero de telefono ya registrado.',
        'nit.max' => 'El documento no puede tener mas de :max caracteres.',
        'phone.max' => 'El documento no puede tener mas de :max caracteres.',
    ];
    public function saveProvider()
    {

        $this->validate([
            'nit' => 'required',
            'name' => 'required',
            'phone' => 'required',

        ]);
        $provider = new Provider();
        $provider->name = $this->name;
        $provider->nit = $this->nit;
        $provider->phone = $this->phone;
        $regstatus=$this->status;
        if($this->status==""){
            $this->status="1";
        };
        $provider->status = $this->status;
        $provider->save();
        $this->showingProviderModal = false;
    }

    public function showEditProviderModal($id)
    {
        $this->provider = Provider::findOrfail($id);
        $this->idProvider = $this->provider->id;
        $this->nit = $this->provider->nit;
        $this->name = $this->provider->name;
        $this->phone = $this->provider->phone;
        $this->status = $this->provider->status;
        $this->isHowToSearchMode = false;
        $this->isEditMode = true;
        $this->showingProviderModal = true;
    }

    public function showHowToSearchModal()
    {
        $this->isHowToSearchMode = true;
        $this->isEditMode = false;
        $this->showingProviderModal = true;
    }
    public function updateProvider(){
        $this->provider->update([
            'nit' => $this->nit,
            'name' => $this->name,
            'phone' => $this->phone,
            'status' => $this->status,
        ]);
        $this->showingProviderModal=false;
    }
    public function delete($id): array
    {
        $provider = Provider::find($id);
        if ($provider->status == "0"){
            $provider->status = "1";
        }elseif ($provider->status == "1"){
            $provider->status = "0";
        }
        return [


            $provider->save()
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
        return Excel::download(new ProvidersExportPdf($this->selecteds, $this->fieldId, $this->fieldNit, $this->fieldName, $this->fieldPhone, $this->fieldStatus), 'providers.xlsx');
    }
    public function exportCsv()
    {
        return Excel::download(new ProvidersExportPdf($this->selecteds, $this->fieldId, $this->fieldNit, $this->fieldName, $this->fieldPhone, $this->fieldStatus), 'providers.csv');
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
        $providers = Provider::all();
        $pdf = PDF::loadView('exports.providerPdf', compact('providers'),['exportData' => $exportData]);
        return $pdf->stream('provider.pdf');

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
        $providers = Provider::where('name', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('phone', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('nit', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('id', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orderBy($this->sortField, $this->sortDirection)->paginate($this->paginate);
        foreach($providers as $provider){
            if(in_array($provider->id, $this->selecteds)){
            }else{
                $this->isSelectedAll+=1;
            }
        }
        return view('livewire.provider-table', ['providers' => $providers]);

    }
}
