<?php

namespace App\Http\Livewire;

use App\Exports\ProductsExportPdf;
use App\Models\Provider;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ProductTable extends Component
{
    use WithPagination;
    public $showingProductModal = false;

    public $productsRendered;
    public $idProduct;
    public $providerSelected='';
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
    public $fieldType = true;
    public $fieldProviders_id = true;
    public $fieldBills_id = true;
    public $fieldName = true;
    public $fieldAmmount = true;
    public $fieldPrice = true;
    public $fieldDate = true;
    public $fieldStatus = true;
    public $validateBills_id;
    public $validateProviders_id;
    public $isSelectedAll = 0;
    public $filter = 1;
    public $filterType = '';
    public $fontSize = 16;
    public $selecteds = [];
    public $fields = ['fieldId', 'fieldProviders_id', 'fieldBills_id', 'fieldName', 'fieldAmmount', 'fieldPrice', 'fieldDate', 'fieldType', 'fieldStatus'];
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
        $products = Product::where('name', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('ammount', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('price', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('updated_at', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('id', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('providers_id', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orwhere('bills_id', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')
            ->orderBy($this->sortField, $this->sortDirection)->paginate($this->paginate);;

        if($this->isSelectedAll!=0){
            foreach($products as $product){
                if(in_array($product->id, $this->selecteds)==false){
                    array_push($this->selecteds, $product->id);
                }
            }
        }else{
            foreach($products as $product){
                $this->selecteds = \array_diff($this->selecteds, [$product->id]);
            }
        }
    }

    public function deselectAll()
    {
        $this->selecteds = [];
    }
    public function setProvider($id)
    {
        $p = Provider::find($id);
        $this->providerSelected = $p->name;
        $this->providers_id = $id;
    }
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
        $this->date = $this->product->updated_at;
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
        ]);
        $product = new Product();
        $product->name = $this->name;
        $product->bills_id = $this->bills_id;
        $product->providers_id = $this->providers_id;
        $product->price = $this->price;
        $product->ammount = $this->ammount;
        if($this->date!=''){
            $product->updated_at = $this->date;
        }
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
        $this->bills_id = $this->product->bills_id;
        $this->providers_id = $this->product->providers_id;
        $this->type = $this->product->type;
        $this->name = $this->product->name;
        $this->ammount = $this->product->ammount;
        $this->price = $this->product->price;
        $this->date = $this->product->updated_at;
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
        $this->product->update([
            'providers_id' => $this->providers_id,
            'bills_id' => $this->bills_id,
            'type' => $this->type,
            'name' => $this->name,
            'ammount' => $this->ammount,
            'price' => $this->price,
            'date' => $this->date,
            'status' => $this->status,
            'updated_at' => $this->date,
        ]);

        

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
        return Excel::download(new ProductsExportPdf($this->selecteds, $this->fieldId, $this->fieldProviders_id, $this->fieldBills_id, $this->fieldName, $this->fieldAmmount, $this->fieldPrice, $this->fieldDate, $this->fieldType, $this->fieldStatus), 'products.xlsx');
    }
    public function exportCsv()
    {
        return Excel::download(new ProductsExportPdf($this->selecteds, $this->fieldId, $this->fieldProviders_id, $this->fieldBills_id, $this->fieldName, $this->fieldAmmount, $this->fieldPrice, $this->fieldDate, $this->fieldType, $this->fieldStatus), 'products.csv');
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
        $products = Product::all();
        $pdf = PDF::loadView('exports.productPdf', compact('products'),['exportData' => $exportData]);
        return $pdf->stream('product.pdf');

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
        $products = Product::where('name', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')->where('type', 'like', '%'.$this->filterType.'%')
            ->orwhere('ammount', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')->where('type', 'like', '%'.$this->filterType.'%')
            ->orwhere('price', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')->where('type', 'like', '%'.$this->filterType.'%')
            ->orwhere('updated_at', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')->where('type', 'like', '%'.$this->filterType.'%')
            ->orwhere('id', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')->where('type', 'like', '%'.$this->filterType.'%')
            ->orwhere('providers_id', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')->where('type', 'like', '%'.$this->filterType.'%')
            ->orwhere('bills_id', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')->where('type', 'like', '%'.$this->filterType.'%')
            ->orderBy($this->sortField, $this->sortDirection)->paginate($this->paginate);
        foreach($products as $product){
            if(in_array($product->id, $this->selecteds)){
            }else{
                $this->isSelectedAll+=1;
            }
        }
        return view('livewire.product-table', ['products' => $products], ['providers' => Provider::all()]);

    }
}