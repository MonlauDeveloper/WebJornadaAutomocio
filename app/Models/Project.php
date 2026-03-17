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
        'conclusion',
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
    public function projectTypes()
    {
        return $this->belongsToMany(
            ProjectType::class,
            'project_project_type',
            'idProject',        
            'idProjectType'       
        );
    }
    public function images()
    {
        return $this->hasMany(ProjectImage::class, 'idProject', 'idProject');
    }

    public function getEmbedVideoUrlAttribute()
{
    if (!$this->videoURL) {
        return null;
    }

    if (str_contains($this->videoURL, 'youtube.com') || str_contains($this->videoURL, 'youtu.be')) {
        $videoId = "";
        if (str_contains($this->videoURL, 'v=')) {
            parse_str(parse_url($this->videoURL, PHP_URL_QUERY), $query);
            $videoId = $query['v'] ?? '';
        } else {
            $videoId = last(explode('/', rtrim($this->videoURL, '/')));
        }
        return "https://www.youtube.com/embed/" . $videoId;
    }
    
    return $this->videoURL;
}

public function votes()
{
    return $this->hasMany(Vote::class, 'project_id', 'idProject');
}

}