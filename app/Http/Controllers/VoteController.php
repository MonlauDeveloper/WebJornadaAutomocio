<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- IMPORTANTE

class VoteController extends Controller
{
    /**
     * Verifica si las votaciones están abiertas.
     */
    private function isVotingOpen()
    {
        $enabled = DB::table('settings')->where('key', 'voting_enabled')->value('value');
        return ($enabled && $enabled != '0');
    }

    public function store(Request $request, $projectId)
    {
        if (!$this->isVotingOpen()) {
            return response()->json([
                'success' => false,
                'message' => 'Lo sentimos, las votaciones están cerradas.'
            ], 403);
        }

        $request->validate(['device_token' => 'required|string']);
        $token = $request->input('device_token');

        // Usamos una transacción para evitar que voten más de 3 veces en ataques rápidos
        return DB::transaction(function () use ($token, $projectId) {
            
            $votosTotales = Vote::where('device_token', $token)->count();

            // 1. Verificar límite global
            if ($votosTotales >= 3) {
                return response()->json([
                    'success' => false,
                    'message' => 'Has alcanzado el límite de 3 votos.'
                ], 403);
            }

            // 2. Intentar crear el voto (evita duplicados para el mismo proyecto)
            $voto = Vote::firstOrCreate([
                'device_token' => $token,
                'project_id' => $projectId
            ]);

            if (!$voto->wasRecentlyCreated) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ya has votado a este proyecto.'
                ], 409);
            }

            return response()->json([
                'success' => true,
                'message' => 'Voto registrado',
                'votos_restantes' => 3 - ($votosTotales + 1)
            ]);
        });
    }

    public function destroy(Request $request, $projectId)
    {
        if (!$this->isVotingOpen()) {
            return response()->json([
                'success' => false,
                'message' => 'Las votaciones han terminado. No puedes modificar tus votos.'
            ], 403);
        }

        $request->validate(['device_token' => 'required|string']);
        $token = $request->input('device_token');

        $deleted = Vote::where('device_token', $token)
            ->where('project_id', $projectId)
            ->delete();

        if ($deleted) {
            $votosActuales = Vote::where('device_token', $token)->count();
            return response()->json([
                'success' => true,
                'message' => 'Voto eliminado',
                'votos_restantes' => 3 - $votosActuales
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Voto no encontrado'], 404);
    }

    public function myVotes(Request $request)
    {
        $request->validate(['device_token' => 'required|string']);
        $votedProjectIds = Vote::where('device_token', $request->device_token)
            ->pluck('project_id');

        return response()->json($votedProjectIds);
    }

    public function ranking()
    {
        // El ranking suele ser público, no necesita token
        $ranking = Vote::select('project_id', DB::raw('count(*) as total_votes'))
            ->with(['project:id,name']) // Asegúrate que la relación en el modelo Vote se llame 'project'
            ->groupBy('project_id')
            ->orderBy('total_votes', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $ranking
        ]);
    }
}