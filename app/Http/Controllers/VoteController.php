<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    // --- ACCIÓN DE VOTAR ---
    public function store(Request $request, $projectId)
    {
        // 1. Validar que Flutter envía el token
        $request->validate([
            'device_token' => 'required|string',
        ]);

        $token = $request->input('device_token');

        // 2. CONTAR: ¿Cuántos votos tiene ya este dispositivo en total?
        $votosTotales = Vote::where('device_token', $token)->count();

        if ($votosTotales >= 3) {
            return response()->json([
                'success' => false,
                'message' => 'Has alcanzado el límite de 3 votos. Quita uno para votar aquí.'
            ], 403);
        }

        // 3. INTENTAR GUARDAR
        // Usamos firstOrCreate para evitar duplicados si le dan dos veces muy rápido
        $voto = Vote::firstOrCreate([
            'device_token' => $token,
            'project_id' => $projectId
        ]);

        // Si se acaba de crear (wasRecentlyCreated es true), todo bien.
        // Si ya existía, significa que ya lo había votado.
        if (!$voto->wasRecentlyCreated) {
             return response()->json([
                'success' => false,
                'message' => 'Ya has votado a este proyecto'
            ], 409); // 409 Conflict
        }

        return response()->json([
            'success' => true,
            'message' => 'Voto registrado',
            'votos_restantes' => 3 - ($votosTotales + 1)
        ]);
    }

    public function myVotes(Request $request)
{
    $request->validate([
        'device_token' => 'required|string',
    ]);

    $token = $request->input('device_token');

    // Devuelve solo una lista de IDs, ej: [1, 5, 12]
    $votedProjectIds = \App\Models\Vote::where('device_token', $token)
        ->pluck('project_id');

    return response()->json($votedProjectIds);
}

    // --- ACCIÓN DE QUITAR VOTO ---
    public function destroy(Request $request, $projectId)
    {
        $request->validate([
            'device_token' => 'required|string',
        ]);

        $token = $request->input('device_token');

        // 1. Buscar el voto específico y borrarlo
        $deleted = Vote::where('device_token', $token)
                       ->where('project_id', $projectId)
                       ->delete();

        if ($deleted) {
            // Recalculamos cuántos le quedan para actualizar la UI del móvil
            $votosActuales = Vote::where('device_token', $token)->count();
            
            return response()->json([
                'success' => true,
                'message' => 'Voto eliminado correctamente',
                'votos_restantes' => 3 - $votosActuales
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No habías votado a este proyecto'
            ], 404);
        }
    }
}