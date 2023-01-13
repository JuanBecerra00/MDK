<?php

namespace App\Http\Livewire;

use App\Exports\CustomersExportPdf;
use App\Models\City;
use App\Models\Department;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class CustomerTable extends Component
{
    use WithPagination;
    public $showingCustomerModal = false;

    public $customersRendered;
    public $idCustomer;
    public $type;
    public $regtype="";
    public $cc;
    public $name;
    public $department_id;
    public $city_id;
    public $phone;
    public $email;
    public $status;
    public $regstatus="";
    public $isEditMode = false;
    public $isHowToSearchMode = false;
    public $customer;

    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $paginate = '5';
    public $fieldId = true;
    public $fieldType = false;
    public $fieldCc = true;
    public $fieldName = true;
    public $fieldDepartment_id = true;
    public $fieldCity_id = true;
    public $fieldEmail = true;
    public $fieldPhone = true;
    public $fieldStatus = true;
    public $validateCc;
    public $validateEmail;
    public $validatePhone;
    public $isSelectedAll = 0;
    public $filter = 1;
    public $department;
    public $selectedDepartment;
    public $city;
    public $selectedCity;
    public $fontSize = 16;
    public $selecteds = [];
    public $fields = ['fieldId', 'fieldCc', 'fieldName', 'fieldDepartment_id', 'fieldCity_id', 'fieldEmail', 'fieldPhone', 'fieldStatus'];
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
        $customers = Customer::where('cc', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('name', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('email', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('phone', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('department_id', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('city_id', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('id', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orderBy($this->sortField, $this->sortDirection)->paginate($this->paginate);;

        if($this->isSelectedAll!=0){
            foreach($customers as $customer){
                if(in_array($customer->id, $this->selecteds)==false){
                    array_push($this->selecteds, $customer->id);
                }
            }
        }else{
            foreach($customers as $customer){
                $this->selecteds = \array_diff($this->selecteds, [$customer->id]);
            }
        }
    }

    public function deselectAll()
    {
        $this->selecteds = [];
    }

    public function showCustomerModal()
    {
        $this->type = '';
        $this->cc = '';
        $this->name = '';
        $this->department_id = '';
        $this->city_id = '';
        $this->email = '';
        $this->phone = '';
        $this->status = '';

        
        $this->selectedDepartment = '';
        $this->selectedCity = '';
        $this->department_id = '';
        $this->city_id = '';

        $this->isEditMode = false;
        $this->isHowToSearchMode = false;
        $this->showingCustomerModal = true;
    }

    public function setDepartment($id)
    {
        if(Department::find($id)){
            $d = Department::find($id);
            $this->department_id = $id;
            $this->selectedDepartment = $d->name;
        }else{
            $this->selectedDepartment = 'No encontrado';
            $this->selectedCity = 'No encontrado';
            $this->department_id = '';
            $this->city_id = '';
        }
        
        $this->selectedCity = '';
        
    }
    public function setCity($id)
    {
        if(City::find($id)){
            $d = City::find($id);
            $this->city_id = $id;
            $this->selectedCity = $d->name;
        }else{
            $this->selectedCity = 'No encontrado';
            $this->city_id = '';
        }
    }
    public function modalRegFormReset()
    {
        $this->type = '';
        $this->cc = '';
        $this->name = '';
        $this->department_id = '';
        $this->city_id = '';
        $this->email = '';
        $this->phone = '';
        $this->status = '';
    }

    public function hideModal()
    {
        $this->showingCustomerModal = false;
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
        'cc' => 'Numero de documento',
        'name' => 'Nombre',
        'email' => 'Correo',
        'phone' => 'Telefono',
        'department_id' => 'Departamento',
        'city_id' => 'Ciudad',
    ];
    protected $messages = [
        'email.email' => 'Direccion de correo invalida.',
        'email.unique' => 'Direccion de correo ya registrada.',
        'cc.unique' => 'Numero de documento ya registrado.',
        'phone.unique' => 'Numero de telefono ya registrado.',
        'cc.max' => 'El documento no puede tener mas de :max caracteres.',
        'phone.max' => 'El documento no puede tener mas de :max caracteres.',
    ];
    public function saveCustomer()
    {

        $this->validate([
            'cc' => 'required|unique:customers,cc|max:15',
            'name' => 'required',
            'phone' => 'required|unique:customers,phone|max:15',
            'email' => 'required|email|unique:customers,email',
            'department_id' => 'required',
            'city_id' => 'required',
        ]);
        $customer = new Customer();
        $regtype=$this->type;
        if($this->type==""){
            $this->type="cc";
        };
        $customer->type = $this->type;
        $customer->cc = $this->cc;
        $customer->name = $this->name;
        $customer->department_id = $this->department_id;
        $customer->city_id = $this->city_id;
        $customer->phone = $this->phone;
        $customer->email = $this->email;
        $regstatus=$this->status;
        if($this->status==""){
            $this->status="1";
        };
        $customer->status = $this->status;
        $customer->save();
        $this->showingCustomerModal = false;
    }

    public function showEditCustomerModal($id)
    {
        $this->customer = Customer::findOrfail($id);
        $this->department = Department::findOrfail($this->customer->department_id);
        $this->city = City::findOrfail($this->customer->city_id);
        $this->idCustomer = $this->customer->id;
        $this->type = $this->customer->type;
        $this->cc = $this->customer->cc;
        $this->name = $this->customer->name;
        $this->department_id = $this->customer->department_id;
        $this->city_id = $this->customer->city_id;
        $this->email = $this->customer->email;
        $this->phone = $this->customer->phone;
        $this->status = $this->customer->status;
        $this->isHowToSearchMode = false;
        $this->isEditMode = true;
        $this->showingCustomerModal = true;
        $this->selectedDepartment = $this->department->name;
        $this->selectedCity = $this->city->name;
    }

    public function showHowToSearchModal()
    {
        $this->isHowToSearchMode = true;
        $this->isEditMode = false;
        $this->showingCustomerModal = true;
    }
    public function updateCustomer(){
        if($this->cc!=$this->customer->cc){
            $this->validateCc = 'required|unique:customers,cc|max:15';
        }else{
            $this->validateCc = '';
        }
        if($this->email!=$this->customer->email){
            $this->validateEmail = 'required|unique:customers,email';
        }else{
            $this->validateEmail = '';
        }
        if($this->phone!=$this->customer->phone){
            $this->validatePhone = 'required|unique:customers,phone|max:15';
        }else{
            $this->validatePhone = '';
        }

        $this->validate([
            'cc' => $this->validateCc,
            'name' => 'required',
            'department_id' => 'required',
            'city_id' => 'required',
            'email' => $this->validateEmail,
            'phone' => $this->validatePhone,
        ]);
        if($this->type==""){
            $this->type="cc";
        };
        if($this->status==""){
            $this->status="1";
        };
        $this->customer->update([
            'type' => $this->type,
            'cc' => $this->cc,
            'name' => $this->name,
            'department_id' => $this->department_id,
            'city_id' => $this->city_id,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status
        ]);

        $this->showingCustomerModal=false;
    }
    public function delete($id): array
    {
        $customer = Customer::find($id);
        if ($customer->status == "0"){
            $customer->status = "1";
        }elseif ($customer->status == "1"){
            $customer->status = "0";
        }
        return [


            $customer->save()
        ];
    }

    public function deleteSelected($id): array
    {
        $customer = Customer::find($id);
        if ($customer->status == "0"){
            $customer->status = "1";
        }elseif ($customer->status == "1"){
            $customer->status = "0";
        }
        return [


            $customer->save()
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
        return Excel::download(new CustomersExportPdf($this->selecteds, $this->fieldId, $this->fieldType, $this->fieldCc, $this->fieldName, $this->fieldDepartment_id, $this->fieldCity_id, $this->fieldEmail, $this->fieldPhone, $this->fieldStatus), 'customers.xlsx');
    }
    public function exportCsv()
    {
        return Excel::download(new CustomersExportPdf($this->selecteds, $this->fieldId, $this->fieldType, $this->fieldCc, $this->fieldName, $this->fieldDepartment_id, $this->fieldCity_id, $this->fieldEmail, $this->fieldPhone, $this->fieldStatus), 'customers.csv');
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
        $customers = Customer::all();
        $pdf = PDF::loadView('exports.customerPdf', compact('customers'),['exportData' => $exportData]);
        return $pdf->stream('customer.pdf');

    }
    public function findDepartment($id)
    {
        $answer = Department::findOrfail($id);
        return $answer->name;
    }
    public function findCity($id)
    {
        $answer = City::findOrfail($id);
        return $answer->name;
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
        $customers = Customer::where('cc', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('type', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('name', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('email', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('phone', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('department_id', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('city_id', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('id', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orderBy($this->sortField, $this->sortDirection)->paginate($this->paginate);

        foreach($customers as $customer){
            if(in_array($customer->id, $this->selecteds)){
            }else{
                $this->isSelectedAll+=1;
            }
        }
        return view('livewire.customer-table', ['customers' => $customers], ['cities' => City::all(), 'departments' => Department::all()]);

    }
}