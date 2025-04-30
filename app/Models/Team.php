<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $primaryKey = 'idTeam';
    public $timestamps = false;

    protected $fillable = [
        'teamName',
        'logo'
    ];

    // Relaciones
    public function students()
    {
        return $this->hasMany(Student::class, 'idTeam');
    }

    public function project()
    {
        return $this->hasOne(Project::class);
    }

}
