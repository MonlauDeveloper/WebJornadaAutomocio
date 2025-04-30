<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;

    protected $primaryKey = 'idSpecialization';
    public $timestamps = false;

    protected $fillable = [
        'specialization',
    ];

    // Relaciones
    public function students()
    {
        return $this->hasMany(Student::class, 'idSpecialization');
    }
}
