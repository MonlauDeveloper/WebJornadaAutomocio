<?php
// App\Models\Ubication.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubication extends Model
{
    use HasFactory;

    // Indicar que la clave primaria es 'idUbication'
    protected $primaryKey = 'idUbication';

    public $timestamps = false;

    protected $fillable = [
        'idUbication',
        'ubicationName',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'idUbication');
    }
}
