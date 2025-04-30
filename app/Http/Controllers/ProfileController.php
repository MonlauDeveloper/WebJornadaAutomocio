<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function updatePassword(Request $request)
    {
        $user = auth()->user(); // El usuario autenticado
    
        // Validación de las contraseñas
        $request->validate([
            'current_password' => 'required|string', // La contraseña actual es obligatoria
            'new_password' => 'required|string|min:8|confirmed', // Nueva contraseña con mínimo 8 caracteres y confirmación
        ]);
    
        // Verificar si la contraseña actual es correcta
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'La contraseña actual no es correcta.');
        }
    
        // Actualizar la contraseña del usuario
        $user->password = Hash::make($request->new_password); // Encriptar la nueva contraseña
        $user->save();
    
        return redirect()->route('profile.show')->with('success', 'Contraseña actualizada correctamente.');
    }    
}
