<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    // Nombre de la tabla (opcional si sigue la convención, pero mejor ponerlo)
    protected $table = 'project_images';

    // Campos que permitimos llenar masivamente
    protected $fillable = [
        'idProject',
        'file_path',
        'fase',
        'orden'
    ];

    // Relación inversa: una imagen pertenece a un proyecto
    public function project()
    {
        return $this->belongsTo(Project::class, 'idProject');
    }
}