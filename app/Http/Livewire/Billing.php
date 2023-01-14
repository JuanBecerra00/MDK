<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Billing extends Component
{
    use WithPagination;
    public $search;
    public $customer;
    public $customerSelected;
    public $customerSearch;
    public $customerName = '';
    public $customerEmail = '';
    public $customerPhone = '';
    public $vehicle = '';
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
    public $productsAmmount = [[0 => '', '']];
    public $productsSelected = [''];
    public $total = 0;
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $paginate = 10;
    public $filterType = 'I';


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
        }else{
            $this->vehiclePlate = 'No encontrado';
            $this->vehicleModel = 'No encontrado';
        }
    }
    public function resetCustomer()
    {
        $this->customer = '';
        $this->customerName = '';
        $this->customerEmail = '';
        $this->customerPhone = '';
    }
    public function resetVehicle()
    {
        $this->vehicle = '';
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
    public function productAdd($value, $id)
    {
        if($value=='on'){
            if(array_search($id, $this->productsSelected)){
                $a=array_search($id, $this->productsSelected);
                $this->test = $a;
                unset($this->productsAmmount[$a]);
                unset($this->productsSelected[$a]);
            }else{
                array_push($this->productsAmmount, [$id, 0, 0]);
                array_push($this->productsSelected, $id);
                $this->test = 'si';
            }
        }
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
    public function render()
    {
        $products = Product::where('status', 'like', '%1%')->where('type', 'like', '%'.$this->filterType.'%')->where('name', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortField, $this->sortDirection)->paginate($this->paginate);
        return view('livewire.billing', ['customers' => Customer::all()], ['vehicles' => Vehicle::all(), 'customers' => Customer::all(), 'products' => $products]);
    }
}
