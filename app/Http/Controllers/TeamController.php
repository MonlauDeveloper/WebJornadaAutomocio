<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    public function index() {
        $teams = Team::paginate(10);
        return view('teams.index', compact('teams'));
    }
    
    public function store(Request $request) {
        $request->validate(['teamName' => 'required|string|max:255']);
        Team::create(['teamName' => $request->teamName]);
        return back()->with('success', 'Equipo creado correctamente.');
    }

    public function update(Request $request, $id) {
        $request->validate(['teamName' => 'required|string|max:255']);
        $team = Team::findOrFail($id);
        $team->update(['teamName' => $request->teamName]);
        return back()->with('success', 'Equipo actualizado.');
    }

    public function destroy($id) {
        Team::findOrFail($id)->delete();
        return back()->with('success', 'Equipo eliminado.');
    }
}
