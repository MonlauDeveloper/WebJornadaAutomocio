<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Apicontroller extends Controller
{
    public function login_API(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('username', $request->user)->first();
        // $user->tokens()->delete(); 
        
        if (!$user || !Hash::check($request->password, $user->password)) { 
             throw ValidationException::withMessages([
                'user' => ['The provided credentials are incorrect.'],
            ]);
        }
        return $user->createToken($request->user)->plainTextToken;
    }

    // --- CONTADORES DE PÁGINAS ---
    public function pages_projects(int $limit) { return ceil(DB::table('projects')->count() / $limit); }
    public function pages_companies(int $limit) { return ceil(DB::table('companies')->count() / $limit); }
    public function pages_dinamicTest(int $limit) { return ceil(DB::table('dynamictestings')->count() / $limit); }
    public function pages_presentations(int $limit) { return ceil(DB::table('presentations')->count() / $limit); }
    public function pages_students(int $limit) { return ceil(DB::table('students')->count() / $limit); }
    
    // --- FUNCIONES DE PAGINACIÓN ---
    private function paginate(string $table, int $limit, int $page, string $order = "title")
    {
        $querry = DB::table($table)->offset(($page - 1) * $limit)->limit($limit)->orderBy($order)->get();
        return $querry;
    }

    public function projects(int $limit, int $page, string $order = "title")
    {
        $columns = array('idProject', 'abstract', 'moodleURL', 'pdfURL', 'photoName', 'specialization', 'title', 'ubicationName', 'videoURL', 'numTribunal');
        $projects = DB::table('projects')
            ->whereNot('projects.idSpecialization', 5)
            ->offset(($page - 1) * $limit)
            ->limit($limit)->orderBy($order)
            ->join('specializations', 'specializations.idSpecialization', 'projects.idSpecialization')
            ->join('ubications', 'ubications.idUbication', 'projects.idUbication')
            ->select($columns)
            ->get();
            
        foreach ($projects as $p) {
            $p->students = DB::table('students')->where('idProject', $p->idProject)->get();
        }
        return $projects;
    }

    public function companies(int $limit, int $page, string $order = "companyName")
    {
        return Apicontroller::paginate('companies', $limit, $page, $order);
    }

    public function presentations(int $limit, int $page, string $order = "presentationName")
    {
        $presentations = Apicontroller::paginate('presentations', $limit, $page, $order);

        foreach ($presentations as $p) {
            $p->ubication = DB::table('presentations')
                ->join('ubications', 'ubications.idUbication', 'presentations.idUbication')
                ->where('presentations.idPresentation', $p->idPresentation)
                ->select('ubicationName')
                ->first()->ubicationName;
                
            $columns_speakers = array('name', 'surname1', 'surname2', 'description');
            $p->speakers = DB::table('speakers')
                ->join('rel_speakers_presentations', 'speakers.idSpeaker', 'rel_speakers_presentations.idSpeaker')
                ->join('presentations', 'presentations.idPresentation', 'rel_speakers_presentations.idPresentation')
                ->where('presentations.idPresentation', $p->idPresentation)
                ->select($columns_speakers)
                ->get();
        }
        return $presentations;
    }

    

    public function students(int $limit, int $page, string $order = "idStudent")
    {
        return Apicontroller::paginate('students', $limit, $page, $order);
    }

    public function dynamictestings(int $limit, int $page, string $order = "title")
    {
        $columns = array('idProject', 'abstract', 'moodleURL', 'pdfURL', 'photoName', 'specialization', 'title', 'ubicationName', 'videoURL', 'teams.logo');
        $projects = DB::table('projects')
            ->where('projects.idSpecialization', 5)
            ->offset(($page - 1) * $limit)
            ->limit($limit)
            ->orderBy($order)
            ->join('specializations', 'specializations.idSpecialization', 'projects.idSpecialization')
            ->join('ubications', 'ubications.idUbication', 'projects.idUbication')
            ->join('teams', 'teams.teamName', '=', 'projects.title')
            ->select($columns)
            ->get();
            
        foreach ($projects as $p) {
            $p->students = DB::table('students')->where('idProject', $p->idProject)->get();
        }
        return $projects;
    }

    // --- DETALLES INDIVIDUALES ---
    public function project(int $id_project)
    {
        $querry2 = DB::table('students')->where('idProject', $id_project)->orderBy('name')->get();
        return $querry2;
    }
    
    public function companie(int $id_companie)
    {
        return DB::table('companies')->where('idCompany', $id_companie)->join('users', 'companies.idUser', 'users.idUser')->orderBy('companyName')->first();
    }
    
    public function presentation(int $idPresentation)
    {
        $columns = array('name', 'surname1', 'surname2', 'description', 'presentationName', 'topic', 'presentationDate', 'ubicationName');

        $speakers = DB::table('speakers')
            ->where('presentations.idPresentation', $idPresentation)
            ->join('rel_speakers_presentations', 'speakers.idSpeaker', 'rel_speakers_presentations.idSpeaker')
            ->join('presentations', 'presentations.idPresentation', 'rel_speakers_presentations.idPresentation')
            ->join('ubications', 'presentations.idUbication', 'ubications.idUbication')
            ->select($columns)->first();
        return $speakers;
    }
    public function student(int $id_student)
    {
        $query = DB::table('students')
            ->where('idStudent', $id_student)
            ->first();
        return $query;
    }
    public function getProjectById(int $id){
        // Usamos el Modelo Project con sus relaciones (Eager Loading)
        // Esto traerá automáticamente los datos de las tablas relacionadas
        $project = \App\Models\Project::with(['students', 'specialization', 'ubication'])
                ->find($id);

        if (!$project) {
        return response()->json(['message' => 'Proyecto no encontrado'], 404);
        }

        return response()->json($project);
    }

    // --- FILTROS ---
    public function projects_filter(int $limit, int $page, $filter, $value, string $order = "title")
    {
        if ($filter == "student") {
            $proj_filter = [];
            $columns = array('projects.idProject','numTribunal', 'abstract', 'moodleURL', 'pdfURL', 'projects.photoName', 'specialization', 'title', 'ubicationName', 'videoURL');
            $projects = DB::table('projects')
                ->offset(($page - 1) * $limit)
                ->limit($limit)->orderBy($order)
                ->join('specializations', 'specializations.idSpecialization', 'projects.idSpecialization')
                ->join('ubications', 'ubications.idUbication', 'projects.idUbication')
                ->join('students', 'projects.idProject', 'students.idProject')
                ->where('name', 'like', '%' . $value . '%')
                ->select($columns)
                ->get();
                
            foreach ($projects as $p) {
                if (DB::table('students')->where('idProject', $p->idProject)->get()->count() > 0) {
                    $p->students = DB::table('students')->where('idProject', $p->idProject)->get();
                    array_push($proj_filter, $p);
                }
            }
            return $proj_filter;
        } else {
            $columns = array('idProject','numTribunal', 'abstract', 'moodleURL', 'pdfURL', 'photoName', 'specialization', 'title', 'ubicationName', 'videoURL');
            $projects = DB::table('projects')
                ->whereLike('projects.' . $filter, '%' . $value . '%')
                ->offset(($page - 1) * $limit)
                ->limit($limit)->orderBy($order)
                ->join('specializations', 'specializations.idSpecialization', 'projects.idSpecialization')
                ->join('ubications', 'ubications.idUbication', 'projects.idUbication')
                ->select($columns)
                ->get();
            foreach ($projects as $p) {
                $p->students = DB::table('students')->where('idProject', $p->idProject)->get();
            }
            return $projects;
        }
    }

    public function projects_filter_pages(int $limit, string $filter, string $value)
    {
        if ($filter == "student") {
            $proj_filter = [];
            $columns = array('projects.idProject', 'abstract', 'moodleURL', 'pdfURL', 'projects.photoName', 'specialization', 'title', 'ubicationName', 'videoURL');
            $projects = DB::table('projects')
                ->join('specializations', 'specializations.idSpecialization', 'projects.idSpecialization')
                ->join('ubications', 'ubications.idUbication', 'projects.idUbication')
                ->join('students', 'projects.idProject', 'students.idProject')
                ->where('name', 'like', '%' . $value . '%')
                ->select($columns)
                ->get();
            foreach ($projects as $p) {
                if (DB::table('students')->where('idProject', $p->idProject)->get()->count() > 0) {
                    $p->students = DB::table('students')->where('idProject', $p->idProject)->get();
                    array_push($proj_filter, $p);
                }
            }
            return ceil(sizeof($proj_filter) / $limit);
        } else {
            $columns = array('idProject', 'abstract', 'moodleURL', 'pdfURL', 'photoName', 'specialization', 'title', 'ubicationName', 'videoURL');
            $projects = DB::table('projects')
                ->whereLike('projects.' . $filter, '%' . $value . '%')
                ->join('specializations', 'specializations.idSpecialization', 'projects.idSpecialization')
                ->join('ubications', 'ubications.idUbication', 'projects.idUbication')
                ->select($columns)
                ->get();
            return ceil(sizeof($projects) / $limit);
        }
    }

    // --- PERFIL DE USUARIO ---
    public function myProfile(Request $request)
    {
        $user = $request->user();
     
        if (!$user) {
            return response()->json(['message' => 'No autenticado'], 401);
        }
     
        // 1. Buscar en ESTUDIANTES
        $student = DB::table('students')->where('idUser', $user->idUser)->first();
        if ($student) {
            $student->user = [
                'idUser' => $user->idUser,
                'username' => $user->username,
                'email' => $user->email ?? 'alumno@monlau.com',
                'idRole' => $user->idRole
            ];
            $student->isTeamLeader = (bool)$student->isTeamLeader;
            return response()->json($student);
        }
     
        // 2. Buscar en EMPRESAS
        $company = DB::table('companies')->where('idUser', $user->idUser)->first();
        if ($company) {
            $company->user = [
                'idUser' => $user->idUser,
                'username' => $user->username,
                'email' => $user->email ?? 'empresa@monlau.com',
                'idRole' => $user->idRole
            ];
            return response()->json($company);
        }
     
        return response()->json(['message' => 'Perfil no encontrado. Revisa la tabla students/companies.'], 404);
    }

    // --- GESTIÓN DE MESAS (Crear y Listar) ---
    public function createCompanyTable(Request $request)
    {
        $request->validate([
            'idCompany' => 'required|integer|exists:companies,idCompany',
            'tableName' => 'required|string|max:255',
        ]);

        $idTable = DB::table('company_tables')->insertGetId([
            'idCompany' => $request->idCompany,
            'tableName' => $request->tableName,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'message' => 'Mesa creada correctamente',
            'data' => [
                'idTable' => $idTable,
                'tableName' => $request->tableName,
                'idCompany' => $request->idCompany
            ]
        ], 201);
    }

    public function getCompanyTables($idCompany)
    {
        $tables = DB::table('company_tables')->where('idCompany', $idCompany)->get();
        return response()->json($tables);
    }

    // --- GESTIÓN DE HORARIOS Y RESERVAS (Integrado con 2 tramos) ---

    public function get_table_slots($idTable)
    {
        // 1. Configuración de TRAMOS HORARIOS
        // 09:30 a 10:30 (Primer bloque)
        // 11:00 a 13:30 (Segundo bloque)
        $ranges = [
            ['start' => '09:30', 'end' => '10:30'],
            ['start' => '11:00', 'end' => '13:30']
        ];
        
        $interval = 10 * 60; // 15 minutos

        // 2. Obtener las reservas existentes
        $bookedSlots = DB::table('time_slots')
            ->where('idTable', $idTable)
            ->join('students', 'time_slots.idStudent', '=', 'students.idStudent')
            ->join('users', 'students.idUser', '=', 'users.idUser')
            ->select('time_slots.start_time', 'users.username')
            ->get();

        // Mapa rápido: '09:30' => 'usuario1'
        $bookedMap = [];
        foreach ($bookedSlots as $slot) {
            $timeKey = date('H:i', strtotime($slot->start_time));
            $bookedMap[$timeKey] = $slot->username;
        }

        // 3. Generar la lista de huecos recorriendo los tramos
        $slots = [];
        $today = date('Y-m-d'); // Fecha de hoy

        foreach ($ranges as $range) {
            $currentTime = strtotime($today . ' ' . $range['start']);
            $endTime = strtotime($today . ' ' . $range['end']);

            while ($currentTime < $endTime) {
                $timeStr = date('H:i', $currentTime);
                // Formato ISO
                $isoDate = date('Y-m-d\TH:i:s', $currentTime);

                $isBooked = array_key_exists($timeStr, $bookedMap);

                $slots[] = [
                    'time' => $isoDate,
                    'isBooked' => $isBooked,
                    'bookedBy' => $isBooked ? $bookedMap[$timeStr] : null
                ];

                $currentTime += $interval;
            }
        }

        return response()->json($slots, 200);
    }

    public function book_table_slot(Request $request, $idTable)
    {
        $request->validate([
            'time' => 'required',
            'username' => 'required' 
        ]);

        $bookingTime = date('Y-m-d H:i:s', strtotime($request->time));

        // 1. Verificar si ya está ocupado
        $exists = DB::table('time_slots')
            ->where('idTable', $idTable)
            ->where('start_time', $bookingTime)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Este horario ya está reservado.'], 409);
        }

        // 2. Obtener ID del estudiante usando el username
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $student = DB::table('students')->where('idUser', $user->idUser)->first();

        if (!$student) {
            return response()->json(['message' => 'Este usuario no es un alumno válido'], 403);
        }

        // 3. Insertar reserva
        DB::table('time_slots')->insert([
            'idTable' => $idTable,
            'start_time' => $bookingTime,
            'idStudent' => $student->idStudent,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json(['message' => 'Reserva confirmada'], 200);
    }

    public function cancel_table_slot(Request $request, $idTable)
    {
        $request->validate([
            'time' => 'required'
        ]);

        $bookingTime = date('Y-m-d H:i:s', strtotime($request->time));

        $deleted = DB::table('time_slots')
            ->where('idTable', $idTable)
            ->where('start_time', $bookingTime)
            ->delete();

        if ($deleted) {
            return response()->json(['message' => 'Reserva cancelada'], 200);
        } else {
            return response()->json(['message' => 'No se encontró la reserva para cancelar'], 404);
        }
    }
    // --- OBTENER MIS RESERVAS (Para restaurar notificaciones) ---
    public function getMyBookings(Request $request)
    {
        $user = $request->user();

        // 1. Obtener el ID de estudiante del usuario logueado
        // (Si entra una Empresa o Admin, no tendrá idStudent, devolvemos array vacío)
        $student = DB::table('students')->where('idUser', $user->idUser)->first();

        if (!$student) {
            return response()->json([]);
        }

        // 2. Buscar reservas FUTURAS (start_time >= ahora)
        // Hacemos JOIN con 'company_tables' y 'companies' para saber con QUIÉN es la cita
        $bookings = DB::table('time_slots')
            ->where('time_slots.idStudent', $student->idStudent)
            ->where('time_slots.start_time', '>=', now()) 
            ->join('company_tables', 'time_slots.idTable', '=', 'company_tables.idTable')
            ->join('companies', 'company_tables.idCompany', '=', 'companies.idCompany')
            ->select(
                'time_slots.start_time',     // Fecha y hora ISO (YYYY-MM-DD HH:mm:ss)
                'companies.companyName',     // Nombre de la empresa (ej: Porsche)
                'company_tables.tableName'   // Nombre de la mesa (ej: Mesa 1)
            )
            ->orderBy('time_slots.start_time', 'asc')
            ->get();

        return response()->json($bookings);
    }
 
}