<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    protected $table = 'project_types';
    protected $primaryKey = 'idProjectType';
    public $timestamps = false; // Como decidimos antes
    protected $fillable = ['name'];

    public function projects()
{
    return $this->belongsToMany(
        Project::class, 
        'project_project_type', 
        'idProjectType', 
        'idProject'
    );
}
}
