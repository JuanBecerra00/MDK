<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\Product;
use App\Models\Bill;
use App\Models\Report;
use Livewire\Component;
use Livewire\WithPagination;

class Billing extends Component
{
    use WithPagination;
    public $totalFinal;
    public $date=[];
    public $day;
    public $month;
    public $year;
    public $search;
    public $customer;
    public $customerId;
    public $customerSelected;
    public $customerSearch;
    public $customerName = '';
    public $customerEmail = '';
    public $customerPhone = '';
    public $vehicle = '';
    public $vehicleId;
    public $oilType;
    public $boxType;
    public $difType;
    public $oilFilterType;
    public $vehicleSearch;
    public $vehiclePlate = '';
    public $vehicleModel = '';
    protected $queryString = ['search'];
    public $test = 0;
    public $procedures = [[0 => '', '']];
    public $proceduresCounter = 0;
    public $procedureName;
    public $procedurePrice;
    public $procedureIsEdit = 0;
    public $procedureLastEdit;
    public $porcedureTotal=0;
    public $productsAmmount = [[0 => '', '', '']];
    public $strProductsAmmount = [];
    public $productsSelected = [''];
    public $total = 0;
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $paginate = 10;
    public $filterType = 'I';
    public $observations = '';
    
    public $strProcedures;
    public $strProductsSelected;
    public $showingBillModal = false;


    public function test($value)
    {
        $this->test=$value;
    }
    public function setCustomer($id)
    {
        $this->customerSearch = Customer::find($id);
        if(Customer::find($id)){
            $this->customerName = $this->customerSearch->name;
            $this->customerEmail = $this->customerSearch->email;
            $this->customerPhone = $this->customerSearch->phone;
            $this->customer = $this->customerSearch->cc;
            $this->customerId = $this->customerSearch->id;
            $this->customerSelected = $this->customerSearch->id;
        }else{
            $this->customerName = 'No encontrado';
            $this->customerEmail = 'No encontrado';
            $this->customerPhone = 'No encontrado';
        }
    }
    public function setVehicle($id)
    {
        $this->vehicleSearch = Vehicle::find($id);
        if(Vehicle::find($id)){
            $this->vehiclePlate = $this->vehicleSearch->plate;
            $this->vehicleModel = $this->vehicleSearch->model;
            $this->vehicle = $this->vehicleSearch->plate;
            $this->vehicleId = $this->vehicleSearch->id;
            $this->setCustomer($this->vehicleSearch->customer_id);
        }else{
            $this->vehiclePlate = 'No encontrado';
            $this->vehicleModel = 'No encontrado';
        }
    }
    public function resetCustomer()
    {
        $this->customer = '';
        $this->customerId = '';
        $this->customerName = '';
        $this->customerEmail = '';
        $this->customerPhone = '';
        $this->resetVehicle();
    }
    public function resetVehicle()
    {
        $this->vehicle = '';
        $this->vehicleId = '';
        $this->vehiclePlate = '';
        $this->vehicleModel = '';
    }
    public function addProcedure($id)
    {
        $this->procedures[0]=$this->procedureName;
    }
    public function procedureSave()
    {
        if($this->procedureName!='' && $this->procedurePrice!=''){
            $this->procedures[$this->procedureIsEdit][0]=$this->procedureName;
        $this->procedures[$this->procedureIsEdit][1]=$this->procedurePrice;
        $this->proceduresCounter++;
        $this->procedureName = '';
        $this->procedurePrice = '';
        $this->procedureIsEdit++;
        if($this->procedureLastEdit){
            $this->procedureIsEdit = $this->procedureLastEdit;
            $this->procedureLastEdit = '';
        }else{
            array_push($this->procedures, [$this->proceduresCounter, '']);
        }
        }
        $lclprocedures = [];
        foreach($this->procedures as $procedure){
            array_push($lclprocedures, implode(',',$procedure));
        }
        $this->strProcedures = implode('|', $lclprocedures);
    }
    public function procedureEdit($id)
    {
        $this->procedureLastEdit = $this->procedureIsEdit;
        $this->procedureIsEdit = $id;
        $this->procedureName = $this->procedures[$id][0];
        $this->procedurePrice = $this->procedures[$id][1];
    }
    public function procedureDelete($id)
    {
        $this->procedures[$id][0]='';
        $this->procedures[$id][1]='';
    }

    
    public function modal($value)
    {
        $this->showingBillModal=$value;
    }
    public function productAdd($value, $id)
    {
        if($value=='on'){
            if(array_search($id, $this->productsSelected)){
                $a=array_search($id, $this->productsSelected);
                $this->test = $a;
                unset($this->productsAmmount[$a]);
                unset($this->productsSelected[$a]);
            }else{
                $product = Product::find($id);
                array_push($this->productsAmmount, [$id, 1, $product->price]);
                array_push($this->productsSelected, $id);
                $this->test = 'si';
            }
        }
        $lclAmmount = [];
        foreach($this->productsAmmount as $product){
            array_push($lclAmmount, implode(',',$product));
        }
        $this->strProductsAmmount = implode('|', $lclAmmount);
    }
    public function productSave($id, $price, $value)
    {
        $a=array_search($id, $this->productsSelected);
        $this->productsAmmount[$a][1]=$value;
        $this->productsAmmount[$a][2]=$value*$price;
    }
    public function changePaginate($number)
    {
        $this->paginate = $number;
    }
    public function filterType($value)
    {
        $this->filterType = $value;
    }

    public function setOilFilterType($value)
    {
        $this->oilFilterType = $value;
    }
    public function saveReport()
    {
        $this->strProductsSelected = implode(',', $this->productsSelected);
        if($this->boxType==''){
            $this->boxType='Ninguno';
        }
        if($this->difType==''){
            $this->difType='Ninguno';
        }
        if($this->oilType==''){
            $this->oilType='Ninguno';
        }
        if($this->oilFilterType==''){
            $this->oilFilterType='Ninguno';
        }
            $this->validate([
                'customer' => 'required',
                'vehicle' => 'required',
            ]);
        $bill = new Report();
        $bill->customer_id = $this->customerId;
        $bill->vehicle_id = $this->vehicleId;
        $bill->oilType = $this->oilType;
        $bill->boxType = $this->boxType;
        $bill->difType = $this->difType;
        $bill->oilFilterType = $this->oilFilterType;
        $bill->procedures = $this->strProcedures;
        $bill->productsSelected = $this->strProductsSelected;
        $bill->productsAmmount = $this->strProductsAmmount;
        $bill->observations = $this->observations;
        $bill->save();
        $this->showingBillModal = false;
    }
    public function render()
    {
        $this->porcedureTotal=0;
                foreach($this->procedures as $procedure){
                  $this->porcedureTotal+=(int)$procedure[1];
                }
        $this->total=0;
                foreach($this->productsAmmount as $product){
                  $this->total+=(int)$product[2];
                }
        $this->totalFinal = $this->porcedureTotal + $this->total;
        $this->day = date('d');
        $this->month = date('m');
        $this->year = date('y');
        $products = Product::where('status', 'like', '%1%')->where('type', 'like', '%'.$this->filterType.'%')->where('name', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortField, $this->sortDirection)->paginate($this->paginate);
        return view('livewire.billing', ['customers' => Customer::all()], ['vehicles' => Vehicle::all(), 'customers' => Customer::all(), 'products' => $products]);
    }
}
