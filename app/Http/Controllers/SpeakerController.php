<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use App\Models\Presentation;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    public function index($presentationId)
    {
        $presentation = Presentation::findOrFail($presentationId);
        // Trae todos los ponentes disponibles que no están ya asignados a esta presentación
        $speakers = Speaker::whereDoesntHave('presentations', function ($query) use ($presentationId) {
            $query->where('rel_speakers_presentations.idPresentation', $presentationId);
        })->get();
        

        return view('presentations.speaker', compact('presentation', 'speakers'));
    }

    // Agregar un ponente a una presentación
    public function addSpeakerToPresentation(Request $request, $presentationId)
    {
        // Validar los datos del nuevo ponente
        $request->validate([
            'name' => 'required|string|max:255',
            'surname1' => 'required|string|max:255',
            'surname2' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Crear el nuevo ponente
        $speaker = Speaker::create([
            'name' => $request->name,
            'surname1' => $request->surname1,
            'surname2' => $request->surname2,
            'company' => $request->company,
            'description' => $request->description,
        ]);

        // Asociar el nuevo ponente con la presentación
        $presentation = Presentation::findOrFail($presentationId);
        $presentation->speakers()->attach($speaker->idSpeaker);

        return redirect()->route('presentations.speaker', $presentationId)->with('success', 'Ponente agregado correctamente.');
    }

    // Eliminar un ponente de una presentación
    public function removeSpeakerFromPresentation($presentationId, $speakerId)
    {
        // Buscar la presentación y el ponente
        $presentation = Presentation::findOrFail($presentationId);
        $speaker = Speaker::findOrFail($speakerId);
    
        // Eliminar la relación entre el ponente y la presentación
        $presentation->speakers()->detach($speakerId);
    
        // Eliminar el ponente de la base de datos
        $speaker->delete();
    
        return redirect()->route('presentations.speaker', $presentationId)->with('success', 'Ponente y relación eliminados correctamente.');
    }    

    // Mostrar formulario para editar ponente
    public function showEditSpeakerForm($presentationId, $speakerId)
    {
        $presentation = Presentation::findOrFail($presentationId);
        $speaker = Speaker::findOrFail($speakerId);
        return view('presentations.editSpeaker', compact('presentation', 'speaker'));
    }

    // Actualizar la información de un ponente en una presentación
    public function updateSpeaker(Request $request, $presentationId, $speakerId)
    {
        $speaker = Speaker::findOrFail($speakerId);
        $speaker->update($request->all());

        return redirect()->route('presentations.speaker', $presentationId)->with('success', 'Ponente actualizado correctamente.');
    }
}
