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
    public $user;

    public $search;
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $paginate = '5';
 
    protected $queryString = ['search'];
    public function showUserModal()
    {
        $this->reset();
        $this->showingUserModal = true;
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
        $user->type = $regtype;
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
        $this->reset();
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
        $this->isEditMode = true;
        $this->showingUserModal = true;
    }
    public function updateUser(){
        $this->validate([
            'cc' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'cpassword' => 'required|same:password',
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
        
        $this->reset();
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
    public function render()
    {
        $users = User::where('cc', 'like', '%'.$this->search.'%')->orderBy($this->sortField, $this->sortDirection)->paginate($this->paginate);
        return view('livewire.user-table', ['users' => $users]);
    }
}
