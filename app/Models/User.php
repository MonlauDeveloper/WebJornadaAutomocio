<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    public $timestamps = false;

    use HasApiTokens, Notifiable;

    // Especificar la clave primaria
    protected $primaryKey = 'idUser';

    // Opcional: Si no usas "id" como incremento automático, especifica si es un entero o no
    public $incrementing = true;

    // Especificar el tipo de clave primaria
    protected $keyType = 'int';

    // Otros atributos del modelo
    protected $fillable = [
        'username',
        'email',
        'password',
        'idRole',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function company()
    {
        return $this->hasOne(Company::class, 'idUser');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'idUser'); // Cambia 'idUser' si usas otro nombre de columna
    }
    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'idUser'); // Cambia 'idUser' si usas otro nombre de columna
    }
}
