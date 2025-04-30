<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    use HasFactory;
    protected $primaryKey = 'idPresentation';

    public $timestamps = false;

    protected $fillable = [
        'presentationName', 
        'topic', 
        'presentationDate', 
        'idUbication'
    ];

    /**
     * Relación muchos a muchos con los ponentes (speakers).
     */
    public function speakers()
    {
        return $this->belongsToMany(Speaker::class, 'rel_speakers_presentations', 'idPresentation', 'idSpeaker');
    }
}
