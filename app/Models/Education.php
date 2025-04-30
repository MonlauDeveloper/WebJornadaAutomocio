<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'educations'; // El nombre de la tabla en la base de datos
    protected $fillable = ['idStudent', 'education'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'idStudent');
    }
}
