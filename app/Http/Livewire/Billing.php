<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Vehicle;
use Livewire\Component;

class Billing extends Component
{
    public $search;
    public $customer;
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


    public function test($value)
    {
        $this->test=$value;
    }
    public function setCustomer($id)
    {
        $this->customerSearch = User::findOrfail($id);
        $this->customerName = $this->customerSearch->name;
        $this->customerEmail = $this->customerSearch->email;
        $this->customerPhone = $this->customerSearch->phone;
        $this->customer = $this->customerSearch->cc;
        $this->search='';
    }
    public function setVehicle($id)
    {
        $this->vehicleSearch = Vehicle::findOrfail($id);
        $this->vehiclePlate = $this->vehicleSearch->plate;
        $this->vehicleModel = $this->vehicleSearch->model;
        $this->vehicle = $this->vehicleSearch->plate;
        $this->search='';
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
    public function render()
    {
        return view('livewire.billing', ['users' => User::all()], ['vehicles' => Vehicle::all()]);
    }
}
