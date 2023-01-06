<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;
    public $showingUserModal = false;

    public $type;
    public $regtype="";
    public $cc;
    public $name;
    public $job;
    public $regjob="";
    public $phone;
    public $email;
    public $password;
    public $cpassword;
    public $question;
    public $answer;
    public $status;
    public $regstatus="";
    public $isEditMode = false;
    public $isFieldsMode = false;
    public $isHowToSearchMode = false;
    public $user;

    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $paginate = '5';
    public $fieldId = true;
    public $fieldType = true;
    public $fieldCc = true;
    public $fieldName = true;
    public $fieldJob = true;
    public $fieldEmail = true;
    public $fieldPhone = true;
    public $fieldQuestion = false;
    public $fieldAnswer = false;
    public $fieldStatus = true;
    public $validateCc;
    public $validateEmail;
    public $validatePhone;
    public $validatePassword;
    public $validateCpassword;
    public $isCheckedAll = '';
    public $filter = 0;
    public $fontSize = 16;
    
    public $search;
    protected $queryString = ['search'];
    public function showUserModal()
    {
        $this->type = '';
        $this->cc = '';
        $this->name = '';
        $this->job = '';
        $this->email = '';
        $this->phone = '';
        $this->question = '';
        $this->answer = '';
        $this->password = '';
        $this->cpassword = '';
        $this->status = '';
        $this->isEditMode = false;
        $this->isFieldsMode = false;
        $this->isHowToSearchMode = false;
        $this->showingUserModal = true;
    }

    public function modalRegFormReset()
    {
        $this->type = '';
        $this->cc = '';
        $this->name = '';
        $this->job = '';
        $this->email = '';
        $this->phone = '';
        $this->question = '';
        $this->answer = '';
        $this->password = '';
        $this->cpassword = '';
        $this->status = '';
    }

    public function modalEditFormReset()
    {
        $this->type = $this->user->type;
        $this->cc = $this->user->cc;
        $this->name = $this->user->name;
        $this->job = $this->user->job;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->question = $this->user->question;
        $this->answer = $this->user->answer;
        $this->status = $this->user->status;
        $this->password = '';
        $this->cpassword = '';
    }

    public function modalFieldsReset()
    {
    $this->fieldId = true;
    $this->fieldType = true;
    $this->fieldCc = true;
    $this->fieldName = true;
    $this->fieldJob = true;
    $this->fieldEmail = true;
    $this->fieldPhone = true;
    $this->fieldQuestion = false;
    $this->fieldAnswer = false;
    $this->fieldStatus = false;
    }

    public function hideModal()
    {
        $this->showingUserModal = false;
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
        'cc' => 'Numero de documento',
        'name' => 'Nombre',
        'email' => 'Correo',
        'phone' => 'Telefono',
        'question' => 'Pregunta clave',
        'answer' => 'Respuesta',
        'password' => 'Contraseña',
        'cpassword' => 'Confirmar contraseña'
    ];
    protected $messages = [
        'cpassword.same' => 'Las contraseñas son diferentes.',
        'email.email' => 'Direccion de correo invalida.',
        'email.unique' => 'Direccion de correo ya registrada.',
        'cc.unique' => 'Numero de documento ya registrado.',
        'phone.unique' => 'Numero de telefono ya registrado.',
    ];
    public function saveUser()
    {
        
            $this->validate([
                'cc' => 'required|unique:users,cc',
                'name' => 'required',
                'phone' => 'required|unique:users,phone',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'cpassword' => 'required|same:password',
                'question' => 'required',
                'answer' => 'required',
            ]);
        $user = new User();
        $regtype=$this->type;
        if($this->type==""){
            $this->type="cc";
        };
        $user->type = $this->type;
        $user->cc = $this->cc;
        $user->name = $this->name;
        $regjob=$this->job;
        if($this->job==""){
            $this->job="t";
        };
        $user->job = $this->job;;
        $user->phone = $this->phone;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->question = $this->question;
        $user->answer = $this->answer;
        $regstatus=$this->status;
        if($this->status==""){
            $this->status="1";
        };
        $user->status = $this->status;
        $user->save();
        $this->showingUserModal = false;
    }

    public function showEditUserModal($id)
    {
        $this->user = User::findOrfail($id);
        $this->type = $this->user->type;
        $this->cc = $this->user->cc;
        $this->name = $this->user->name;
        $this->job = $this->user->job;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->question = $this->user->question;
        $this->answer = $this->user->answer;
        $this->status = $this->user->status;
        $this->password = '';
        $this->cpassword = '';
        $this->isHowToSearchMode = false;
        $this->isEditMode = true;
        $this->isFieldsMode = false;
        $this->showingUserModal = true;
    }

    public function showFieldsModal()
    {
        $this->isHowToSearchMode = false;
        $this->isEditMode = false;
        $this->isFieldsMode = true;
        $this->showingUserModal = true;
    }

    public function showHowToSearchModal()
    {
    $this->isHowToSearchMode = true;
    $this->isEditMode = false;
    $this->isFieldsMode = false;
    $this->showingUserModal = true;
    }
    public function updateUser(){
        if($this->cc!=$this->user->cc){
            $this->validateCc = 'required|unique:users,cc';
        }else{
            $this->validateCc = '';
        }
        if($this->email!=$this->user->email){
            $this->validateEmail = 'required|unique:users,email';
        }else{
            $this->validateEmail = '';
        }
        if($this->phone!=$this->user->phone){
            $this->validatePhone = 'required|unique:users,phone';
        }else{
            $this->validatePhone = '';
        }
        
        if($this->password!='' or $this->cpassword!=''){
            $this->validatePassword = 'required';
            $this->validateCpassword = 'required|same:password';
        }else{
            $this->validatePassword = '';
            $this->validateCpassword = '';
        }
        
        $this->validate([
            'cc' => $this->validateCc,
            'name' => 'required',
            'email' => $this->validateEmail,
            'phone' => $this->validatePhone,
            'password' => $this->validatePassword,
            'cpassword' => $this->validateCpassword,
            'question' => 'required',
            'answer' => 'required',
        ]);
        if($this->type==""){
            $this->type="cc";
        };
        if($this->job==""){
            $this->job="t";
        };
        if($this->status==""){
            $this->status="1";
        };
        if($this->password==''){
        $this->user->update([
            'type' => $this->type,
            'cc' => $this->cc,
            'name' => $this->name,
            'job' => $this->job,
            'email' => $this->email,
            'phone' => $this->phone,
            'question' => $this->question,
            'answer' => $this->answer,
            'status' => $this->status
        ]);
        }else{
            $this->user->update([
                'type' => $this->type,
                'cc' => $this->cc,
                'name' => $this->name,
                'job' => $this->job,
                'email' => $this->email,
                'phone' => $this->phone,
                'password' => Hash::make($this->password),
                'question' => $this->question,
                'answer' => $this->answer,
                'status' => $this->status
            ]);
        }
        
        $this->showingUserModal=false;
    }
    public function delete($id): array
    {
        $user = User::find($id);
        if ($user->status == "0"){
            $user->status = "1";
        }elseif ($user->status == "1"){
            $user->status = "0";
        }
        return [


        $user->save()
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
        $users = User::where('cc', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')->orwhere('name', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')->orwhere('email', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')->orwhere('phone', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')->orwhere('question', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')->orwhere('answer', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')->orwhere('id', 'like', '%'.$this->search.'%')->where('status', 'like', '%'.$this->filter.'%')->orderBy($this->sortField, $this->sortDirection)->paginate($this->paginate);
        return view('livewire.user-table', ['users' => $users]);
    }
}
