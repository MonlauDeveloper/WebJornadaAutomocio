<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'idStudent'; // Definir el campo primario
    public $timestamps = false; // Si no tienes `created_at` y `updated_at`

    protected $fillable = [
        'name',
        'surname1',
        'surname2',
        'photoName',
        'cvLink',
        'isTeamLeader',
        'idUser',
        'idSpecialization',
        'curso',
        'idTeam',
        'idProject',
        'verification_status',
    ];
    
    // Relaciones
    public function team()
    {
        return $this->belongsTo(Team::class, 'idTeam');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'idSpecialization');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'idProject');
    }
    
    public function educations()
    {
        return $this->hasMany(Education::class, 'idStudent');
    }

    public function languages()
    {
        return $this->hasMany(Language::class, 'idStudent');
    }

    public function workExperiences()
    {
        return $this->hasMany(WorkExperience::class, 'idStudent');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'idStudent');
    }

}
