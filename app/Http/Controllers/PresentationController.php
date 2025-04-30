<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use App\Models\Ubication;
use Illuminate\Http\Request;

use Carbon\Carbon;

class PresentationController extends Controller
{
    // Mostrar todas las presentaciones con sus ponentes
    public function index()
    {
        // Ordena las presentaciones por el campo presentationDate (suponiendo que presentationDate contiene tanto la fecha como la hora)
        $presentations = Presentation::with('speakers')
            ->orderBy('presentationDate', 'asc') // Ordenar por fecha y hora ascendentemente
            ->get();
    
        return view('presentations.index', compact('presentations'));
    }    

    // Mostrar formulario de edición de presentación
    public function edit($idPresentation)
    {
        $presentation = Presentation::where('idPresentation', $idPresentation)->firstOrFail();
        
        // Asegúrate de que presentationDate es un objeto Carbon
        $presentation->presentationDate = Carbon::parse($presentation->presentationDate);
        $ubications = Ubication::all();

        return view('presentations.edit', compact('presentation', 'ubications'));
    }

    // Actualizar una presentación
    public function update(Request $request, $idPresentation)
    {
        $request->validate([
            'presentationName' => 'required|string|max:255',
            'topic' => 'required|string|max:255',
            'presentationDate' => 'required|date_format:H:i',  // Validación para formato de hora
            'idUbication' => 'required|string|max:255',
        ]);

        $presentation = Presentation::where('idPresentation', $idPresentation)->firstOrFail();
        
        // Convertir la hora a formato 'H:i' usando Carbon
        $presentation->presentationDate = Carbon::createFromFormat('H:i', $request->presentationDate)->toTimeString();
        
        $presentation->update($request->all());

        return redirect()->route('presentations.index')->with('success', 'Presentación actualizada correctamente.');
    }


    // Eliminar una presentación
    public function destroy($idPresentation)
    {
        $presentation = Presentation::where('idPresentation', $idPresentation)->firstOrFail();
    
        // Eliminar las relaciones entre la presentación y los ponentes
        $presentation->speakers()->detach(); 
    
        // eliminar los ponentes asociados, 
        $presentation->speakers()->delete(); 
    
        // Ahora elimina la presentación
        $presentation->delete();
    
        return redirect()->route('presentations.index')->with('success', 'Presentación y ponentes eliminados correctamente.');
    }
    

    // Agregar una nueva presentación
    public function create()
    {
        $ubications = Ubication::all();
        return view('presentations.create', compact('ubications'));
    }

    // Guardar una nueva presentación
    public function store(Request $request)
    {
        $request->validate([
            'presentationName' => 'required|string|max:255',
            'topic' => 'required|string|max:255',
            'presentationDate' => 'required|date_format:H:i',  // Validación para formato de hora
            'idUbication' => 'required|string|max:255',
        ]);

        // Crear nueva presentación y asegurarse de que la hora es guardada correctamente
        $presentation = new Presentation($request->all());
        $presentation->presentationDate = Carbon::createFromFormat('H:i', $request->presentationDate)->toTimeString();
        $presentation->save();

        return redirect()->route('presentations.index')->with('success', 'Presentación agregada correctamente.');
    }

}
