<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    // Permitir guardar estos datos masivamente
    protected $fillable = ['device_token', 'project_id'];

    // Opcional: Si necesitas acceder a datos del proyecto desde el voto
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}