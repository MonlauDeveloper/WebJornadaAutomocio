<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $dates = ['birthDate'];
    protected $fillable = [
        'company', 
        'name', 
        'surname1', 
        'surname2', 
        'description'
    ];

    public function presentations()
    {
        return $this->belongsToMany(Presentation::class, 'rel_speakers_presentations', 'idSpeaker', 'idPresentation');
    }
    
    // Definir la clave primaria explícita
    protected $primaryKey = 'idSpeaker';
}
