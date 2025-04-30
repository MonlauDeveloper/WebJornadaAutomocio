<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $primaryKey = 'idCompany';

    protected $table = 'companies'; // Si el nombre de la tabla no es el convencional
    public $timestamps = false;

    protected $fillable = [
        'companyName',
        'companyWeb',
        'asistenteNombre',
        'asistenteApellidos',
        'telefonoAsistente',
        'emailAsistente',
        'cargoAsistente',
        'idUser',
        'logo_url'
    ];

    /**
     * Relación con el usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    /**
     * Relación con speakers.
     */
    public function speakers()
    {
        return $this->hasMany(Speaker::class, 'idCompany', 'id');
    }
}
