<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $primaryKey = 'idProject';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'idSpecialization',
        'curso',
        'photoName',
        'videoURL',
        'pdfURL',
        'moodleURL',
        'abstract',
        // 'idProjectType',
        'idUbication',
        'numTribunal',
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'idProject');
    }

    // app/Models/Project.php
    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'idSpecialization'); // idSpecialization es la clave foránea
    }

    public function ubication()
    {
        return $this->belongsTo(Ubication::class, 'idUbication');  // Define la relación
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id'); // Asumiendo que team_id es el campo de la relación
    }
    public function projectType()
    {
        // Relación Muchos a Muchos 
        return $this->belongsToMany(ProjectType::class, 'project_project_type', 'idProject', 'idProjectType');
    }
    public function images()
{
    return $this->hasMany(ProjectImage::class, 'idProject', 'idProject');
}

}