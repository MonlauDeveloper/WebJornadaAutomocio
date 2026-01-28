<?php

namespace App\Http\Controllers;
 
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class ChatMessageController extends Controller
{
    // ENVIAR MENSAJE (Alumnos e Invitados)
    public function store(Request $request, $id)
    {
        $request->validate(['content' => 'required|string|max:500']);
 
        $user = Auth::guard('sanctum')->user();
        $userName = $request->userName ?? 'Invitado'; // userName enviado por la App si es invitado
        $isTeacher = false;
 
        if ($user) {
            $userName = $user->name . ' ' . $user->surname1;
            // Lógica de profesor: @monlau.com pero no @campus.monlau.com
            if (str_ends_with($user->email, '@monlau.com') && !str_ends_with($user->email, '@campus.monlau.com')) {
                $isTeacher = true;
            }
        }
 
        // Opcional: Doble validación de delay en el servidor
        $lastMsg = ChatMessage::where('userName', $userName)
            ->where('created_at', '>', now()->subMinute())
            ->first();
        if ($lastMsg && !$isTeacher) {
            return response()->json(['message' => 'Espera 1 min.'], 429);
        }
 
        $message = ChatMessage::create([
            'presentation_id' => $id,
            'userName' => $userName,
            'content' => $request->content,
            'isTeacher' => $isTeacher,
            'isValidated' => $isTeacher, // Los profesores no necesitan moderación
        ]);
 
        return response()->json($message, 201);
    }
 
    // VER MENSAJES VALIDADOS (Para Alumnos)
    public function getValidated($id)
    {
        return ChatMessage::where('presentation_id', $id)
            ->where('isValidated', true)
            ->orderBy('created_at', 'asc')
            ->get();
    }
 
    // VER TODOS LOS MENSAJES (Para Profesores/Moderadores)
    public function getAll($id)
    {
        return ChatMessage::where('presentation_id', $id)
            ->orderBy('created_at', 'asc')
            ->get();
    }
 
    // MODERAR MENSAJE (Aprobar o Rechazar)
    public function validateMessage(Request $request, $messageId)
    {
        $message = ChatMessage::findOrFail($messageId);
        $approve = $request->input('approve', true);
 
        if ($approve) {
            $message->update(['isValidated' => true, 'isRejected' => false]);
        } else {
            $message->update(['isValidated' => false, 'isRejected' => true]);
        }
 
        return response()->json(['success' => true]);
    }
}