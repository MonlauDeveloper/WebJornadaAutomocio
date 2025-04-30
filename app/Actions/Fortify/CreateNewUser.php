<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        // Determinar si es una empresa o un usuario normal
        $isCompany = isset($input['companyName']) && !empty($input['companyName']);

        // Reglas de validación comunes
        $rules = [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => $this->passwordRules(),
        ];

        if ($isCompany) {
            // Validaciones específicas para empresas
            $rules = array_merge($rules, [
                'companyName' => ['required', 'string', 'max:255'],
                'companyWeb' => ['required', 'url', 'max:255'],
                'asistenteNombre' => ['required', 'string', 'max:255'],
                'asistenteApellidos' => ['required', 'string', 'max:255'],
                'telefonoAsistente' => ['required', 'string', 'max:15'],
                'cargoAsistente' => ['required', 'string', 'max:255'],
            ]);
        } else {
            // Validaciones específicas para usuarios normales
            $rules['username'] = ['required', 'string', 'max:255', 'unique:users,username'];
        }

        $validator = Validator::make($input, $rules);
        $validator->validate();

        // Crear el usuario
        $user = User::create([
            'username' => $isCompany ? $input['companyName'] : $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'status' => $isCompany ? 'pending' : 'approved',
            'idRole' => $isCompany ? 5 : 2, // 5 para empresas, 2 para usuarios normales
        ]);

        // Si es una empresa, crear el registro en la tabla companies
        if ($isCompany) {
            Company::create([
                'companyName' => $input['companyName'],
                'companyWeb' => $input['companyWeb'],
                'asistenteNombre' => $input['asistenteNombre'],
                'asistenteApellidos' => $input['asistenteApellidos'],
                'telefonoAsistente' => $input['telefonoAsistente'],
                'emailAsistente' => $input['email'],
                'cargoAsistente' => $input['cargoAsistente'],
                'idUser' => $user->idUser,
            ]);
        }

        return $user;
    }
}