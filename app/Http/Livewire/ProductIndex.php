<?php

namespace App\Http\Livewire;

use App\Exports\ProductsExport;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ProductIndex extends Component
{
    use WithPagination;
    public $showingProductModal = false;

    public $productsRendered;
    public $idProduct;
    public $type;
    public $regtype="";
    public $providers_id;
    public $bills_id;
    public $name;
    public $ammount;
    public $price;
    public $date;
    public $status;
    public $regstatus="";
    public $isEditMode = false;
    public $isHowToSearchMode = false;
    public $product;

    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $paginate = '5';
    public $fieldId = true;
    public $fieldproviders_id = true;
    public $fieldbills_id = true;
    public $fieldName = true;
    public $fieldAmmount = true;
    public $fieldPrice = true;
    public $fieldDate = true;
    public $fieldStatus = true;
    public $validateCc;
    public $isCheckedAll = '';
    public $filter = 1;
    public $fontSize = 16;

    public $search;
    protected $queryString = ['search'];
    public function showProductModal()
    {
        $this->type = '';
        $this->bills_id = '';
        $this->providers_id = '';
        $this->name = '';
        $this->ammount = '';
        $this->price = '';
        $this->date = '';
        $this->status = '';
        $this->isEditMode = false;
        $this->isHowToSearchMode = false;
        $this->showingProductModal = true;
    }

    public function modalRegFormReset()
    {
        $this->type = '';
        $this->bills_id = '';
        $this->providers_id = '';
        $this->name = '';
        $this->ammount = '';
        $this->price = '';
        $this->date = '';
        $this->status = '';
    }

    public function modalEditFormReset()
    {
        $this->type = $this->product->type;
        $this->bills_id = $this->product->bills_id;
        $this->providers_id = $this->product->providers_id;
        $this->name = $this->product->name;
        $this->ammount = $this->product->ammount;
        $this->price = $this->product->price;
        $this->date = $this->product->date;
        $this->status = $this->product->status;
    }

    public function hideModal()
    {
        $this->showingProductModal = false;
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
    }


    protected $validationAttributes = [
        'bills_id' => 'Id de la factura',
        'providers_id' => 'id del proveedor',
        'name' => 'Nombre',
        'ammount' => 'Cantidad',
        'price' => 'Precio',
        'date' => 'Fecha'
    ];
    protected $messages = [
        'bills_id.same' => 'La id de la factura no esta registrada.',
        'providers_id.same' => 'La id del proveedor no esta registrado.',
    ];
    public function saveProduct()
    {

        $this->validate([
            'bills_id' => 'required',
            'providers_id' => 'required',
            'name' => 'required',
            'ammount' => 'required',
            'price' => 'required',
            'date' => 'required',
        ]);
        $product = new Product();
        $product->name = $this->name;
        $product->bills_id = $this->bills_id;
        $product->providers_id = $this->providers_id;
        $product->price = $this->price;
        $product->date = $this->date;
        $regtype=$this->type;
        if($this->type==""){
            $this->type="C";
        };
        $product->type = $this->type;
        $regstatus=$this->status;
        if($this->status==""){
            $this->status="1";
        };
        $product->status = $this->status;
        $product->save();
        $this->showingProductModal = false;
    }

    public function showEditProductModal($id)
    {
        $this->product = Product::findOrfail($id);
        $this->idProduct = $this->product->id;
        $this->bills_id = $this->product->id;
        $this->providers_id = $this->product->id;
        $this->type = $this->product->type;
        $this->name = $this->product->name;
        $this->ammount = $this->product->ammount;
        $this->price = $this->product->price;
        $this->status = $this->product->status;
        $this->isHowToSearchMode = false;
        $this->isEditMode = true;
        $this->showingProductModal = true;
    }

    public function showHowToSearchModal()
    {
        $this->isHowToSearchMode = true;
        $this->isEditMode = false;
        $this->showingProductModal = true;
    }
    public function updateProduct(){
        if($this->bills_id!=$this->product->bills_id){
            $this->validateBills_id = 'required';
        }else{
            $this->validateBills_id = '';
        }

        $this->validate([
            'bills_id' => $this->validateBills_id,
            'providers_id' => $this->validateProviders_id,
            'name' => 'required',
            'ammount' => 'require',
            'price' => 'require',
        ]);
        if($this->type==""){
            $this->type="C";
        };

        if($this->status==""){
            $this->status="1";
        };

        $this->showingProductModal=false;
    }
    public function delete($id): array
    {
        $product = Product::find($id);
        if ($product->status == "0"){
            $product->status = "1";
        }elseif ($product->status == "1"){
            $product->status = "0";
        }
        return [


            $product->save()
        ];
    }

    public function selectAll()
    {
        if($this->isCheckedAll==''){
            $this->isCheckedAll = "checked";
        }else{
            $this->isCheckedAll = "";
        }
    }

    public function fontSizeBigger()
    {
        $this->fontSize+=1;
    }

    public function fontSizeSmaller()
    {
        $this->fontSize-=1;
    }
    public function render()
    {
        $Products = Product::where('name', 'like', '%'.$this->search.'%')->orderBy($this->sortField, $this->sortDirection)->paginate($this->paginate);
        foreach($Products as $Product){
            if(in_array($Product->id, $this->selecteds)){
            }else{
                $this->isSelectedAll+=1;
            }
        }
        return view('livewire.Product-table', ['Products' => $Products]);

    }
}
