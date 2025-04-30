<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['idStudent', 'work_experience'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'idStudent');
    }
}
