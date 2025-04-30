<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla si no sigue la convención de nombres pluralizados
    protected $table = 'roles';

    // Si no usas las columnas created_at y updated_at, indícalo
    public $timestamps = false;

    // Si tienes columnas que quieres permitir para la inserción masiva
    protected $fillable = ['role'];
}
