<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    
    public function create(array $input)
    {
        $dbUsers = User::all();
        $dbUsersEmails = [];
        foreach($dbUsers as $user){
            array_push($dbUsersEmails, $user->email);
        }

        $userCodes = [];
        if(User::whereEmail($input['email'])->first()){
            $dbUsers = User::whereEmail($input['email'])->first();
            array_push($userCodes, $dbUsers->answer);
        }
        

        Validator::make($input, [
            'email' => ['required', 'string', 'email', 'max:255', Rule::in($dbUsersEmails)],
            'code' => ['required', 'string', 'max:255', Rule::in($userCodes)],
            'password' => ['required', 'string', 'min:8', 'max:25'],
            'password_confirmation' => ['same:password'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ], [
            'email.in' => 'Correo no encontrado.',
            'code.in' => 'Clave de seguridad incorrecta.',
            'password.min' => 'La contraseña debe tener al menos 8 digitos.',
            'password.max' => 'La contraseña debe tener menos de 25 digitos.',
            'password_confirmation.same' => 'El campo "Contraseña" no coincide con el campo "Confirmar contraseña".',
        ])->validate();

        

        $user =  User::whereEmail($input['email'])->first();
        $user->update([
            'password' => Hash::make($input['password']),
        ]);
        return User::whereEmail($input['email'])->first();
    }
}
