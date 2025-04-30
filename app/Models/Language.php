<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['idStudent', 'language'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'idStudent');
    }
}
