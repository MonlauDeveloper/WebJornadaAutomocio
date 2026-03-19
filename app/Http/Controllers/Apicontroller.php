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
        $loginField = $request->has('user') ? 'user' : 'email';

        $credentials = $request->validate([
            $loginField => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->$loginField)
                    ->orWhere('username', $request->$loginField)
                    ->first();

        // Verificamos usuario y contraseña (el hash que pusimos en HeidiSQL)
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciales no válidas'], 401);
        }

        // Generamos el token de Sanctum para Flutter
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'idRole' => $user->idRole,
            'user' => $user
        ]);
    }

    public function pages_projects(int $limit)
    {
        return ceil(DB::table('projects')->count() / $limit);
    }
    public function pages_companies(int $limit)
    {
        return ceil(DB::table('companies')->count() / $limit);
    }
    public function pages_dinamicTest(int $limit)
    {
        return ceil(DB::table('dynamictestings')->count() / $limit);
    }
    public function pages_presentations(int $limit)
    {
        return ceil(DB::table('presentations')->count() / $limit);
    }
    public function pages_students(int $limit)
    {
        return ceil(DB::table('students')->count() / $limit);
    }

    private function paginate(string $table, int $limit, int $page, string $order = "title")
    {
        $querry = DB::table($table)->offset(($page - 1) * $limit)->limit($limit)->orderBy($order)->get();
        return $querry;
    }

    public function projects(int $limit, int $page, string $order = "title")
    {
        $columns = array('idProject', 'abstract', 'moodleURL', 'pdfURL', 'photoName', 'specialization', 'title', 'ubicationName', 'videoURL', 'numTribunal', 'curso');
        
        $projects = DB::table('projects')
            ->whereNot('projects.idSpecialization', 5)
            ->offset(($page - 1) * $limit)
            ->limit($limit)
            ->orderBy($order)
            ->join('specializations', 'specializations.idSpecialization', 'projects.idSpecialization')
            ->join('ubications', 'ubications.idUbication', 'projects.idUbication')
            ->select($columns)
            ->get();

        foreach ($projects as $p) {
            $p->students = DB::table('students')->where('idProject', $p->idProject)->get();
            
            $p->project_types = DB::table('project_types')
                ->join('project_project_type', 'project_types.idProjectType', '=', 'project_project_type.idProjectType')
                ->where('project_project_type.idProject', $p->idProject)
                ->select('project_types.idProjectType', 'project_types.name')
                ->get();
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
        $columns = array('idProject', 'abstract', 'moodleURL', 'pdfURL', 'photoName', 'specialization', 'title', 'ubicationName', 'videoURL', 'teams.logo', 'curso');
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
    public function getProjectById(int $id)
{
    $project = \App\Models\Project::with(['students', 'specialization', 'ubication', 'projectTypes'])
        ->where('idProject', $id)
        ->first();

    if (!$project) {
        return response()->json(['message' => 'Proyecto no encontrado'], 404);
    }

    if ($project->pdfURL && !str_starts_with($project->pdfURL, 'http')) {
        $project->pdfURL = asset('storage/' . $project->pdfURL);
    }

    return response()->json([
        'proyecto' => $project
    ]);
}

    public function projects_filter(int $limit, int $page, $filter, $value, string $order = "title")
    {
        if ($filter == "student") {
            $proj_filter = [];
            $columns = array('projects.idProject', 'numTribunal', 'abstract', 'moodleURL', 'pdfURL', 'projects.photoName', 'specialization', 'title', 'ubicationName', 'videoURL', 'curso');
            $projects = DB::table('projects')
                ->offset(($page - 1) * $limit)
                ->limit($limit)->orderBy($order)
                ->join('specializations', 'specializations.idSpecialization', 'projects.idSpecialization')
                ->join('ubications', 'ubications.idUbication', 'projects.idUbication')
                ->join('students', 'projects.idProject', 'students.idProject')
                ->where('students.name', 'like', '%' . $value . '%')
                ->orWhere('students.surname1', 'like', '%' . $value . '%')
                ->select($columns)
                ->get();

            foreach ($projects as $p) {
                $p->students = DB::table('students')->where('idProject', $p->idProject)->get();
                $proj_filter[] = $p;
            }
            return $proj_filter;
        } else {
            $columns = array('idProject', 'numTribunal', 'abstract', 'moodleURL', 'pdfURL', 'photoName', 'specialization', 'title', 'ubicationName', 'videoURL', 'curso');
            $projects = DB::table('projects')
                ->where('projects.' . $filter, 'like', '%' . $value . '%')
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

    public function search_projects_global(Request $request, $query)
    {
        $isMonlauTech = $request->query('monlauTech', '0');

        $columns = array(
            'projects.idProject', 
            'projects.numTribunal', 
            'projects.abstract', 
            'projects.moodleURL', 
            'projects.pdfURL', 
            'projects.photoName', 
            'specializations.specialization', 
            'projects.title', 
            'ubications.ubicationName', 
            'projects.videoURL', 
            'projects.curso'
        );
        
        $projectsQuery = DB::table('projects')
            ->join('specializations', 'specializations.idSpecialization', 'projects.idSpecialization')
            ->join('ubications', 'ubications.idUbication', 'projects.idUbication')
            ->leftJoin('students', 'projects.idProject', '=', 'students.idProject')
            ->where(function($q) use ($query) {
                $q->where('projects.title', 'like', '%' . $query . '%')
                  ->orWhere('students.name', 'like', '%' . $query . '%')
                  ->orWhere('students.surname1', 'like', '%' . $query . '%');
            });

        if ($isMonlauTech == '1') {
            $projectsQuery->where('projects.idSpecialization', 5);
        } else {
            $projectsQuery->where('projects.idSpecialization', '!=', 5);
        }

        $projects = $projectsQuery->select($columns)
            ->distinct()
            ->limit(50)
            ->get();

        foreach ($projects as $p) {
            $p->students = DB::table('students')->where('idProject', $p->idProject)->get();
        }
        
        return response()->json($projects);
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
                ->where('projects.' . $filter, 'like', '%' . $value . '%')
                ->join('specializations', 'specializations.idSpecialization', 'projects.idSpecialization')
                ->join('ubications', 'ubications.idUbication', 'projects.idUbication')
                ->select($columns)
                ->get();
            return ceil(sizeof($projects) / $limit);
        }
    }

    public function myProfile(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'No autenticado'], 401);
        }

        $userId = $user->idUser;

        $teacher = DB::table('teachers')->where('idUser', $userId)->first();
        if ($teacher) {
            return response()->json([
                'type' => 'teacher',
                'name' => $teacher->name,
                'surname1' => $teacher->surname1,
                'surname2' => $teacher->surname2,
                'user' => [
                    'idUser' => $user->idUser,
                    'username' => $user->username,
                    'email' => $user->email,
                    'idRole' => $user->idRole
                ]
            ]);
        }

        $student = DB::table('students')->where('idUser', $userId)->first();
        if ($student) {
            $student->type = 'student';
            $student->user = [
                'idUser' => $user->idUser,
                'username' => $user->username,
                'email' => $user->email ?? 'alumno@monlau.com',
                'idRole' => $user->idRole
            ];
            return response()->json($student);
        }

        $company = DB::table('companies')->where('idUser', $userId)->first();
        if ($company) {
            $company->type = 'company';
            $company->user = [
                'idUser' => $user->idUser,
                'username' => $user->username,
                'email' => $user->email ?? 'empresa@monlau.com',
                'idRole' => $user->idRole
            ];
            return response()->json($company);
        }

        return response()->json(['message' => 'Perfil no encontrado en teachers, students ni companies.'], 404);
    }

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

    public function get_table_slots($idTable)
    {
        $ranges = [
            ['start' => '09:30', 'end' => '10:30'],
            ['start' => '11:00', 'end' => '13:30']
        ];

        $interval = 10 * 60; 

        $bookedSlots = DB::table('time_slots')
            ->where('idTable', $idTable)
            ->leftJoin('students', 'time_slots.idStudent', '=', 'students.idStudent')
            ->leftJoin('users', 'students.idUser', '=', 'users.idUser')
            ->select(
                'time_slots.start_time', 
                'users.username', 
                'time_slots.idStudent', 
                'students.name', 
                'students.surname1'
            )
            ->get();

        $bookedMap = [];
        foreach ($bookedSlots as $slot) {
            $timeKey = date('H:i', strtotime($slot->start_time));
            $bookedMap[$timeKey] = [
                'username' => $slot->username,
                'idStudent' => $slot->idStudent,
                'fullName' => $slot->name ? trim($slot->name . ' ' . $slot->surname1) : null
            ];
        }

        $slots = [];
        $today = date('Y-m-d'); 

        foreach ($ranges as $range) {
            $currentTime = strtotime($today . ' ' . $range['start']);
            $endTime = strtotime($today . ' ' . $range['end']);

            while ($currentTime < $endTime) {
                $timeStr = date('H:i', $currentTime);
                $isoDate = date('Y-m-d\TH:i:s', $currentTime);
                $isBooked = array_key_exists($timeStr, $bookedMap);
                $isBlocked = $isBooked && is_null($bookedMap[$timeStr]['idStudent']);

                $slots[] = [
                    'time' => $isoDate,
                    'isBooked' => $isBooked,
                    'isBlocked' => $isBlocked,
                    'bookedBy' => ($isBooked && !$isBlocked) ? $bookedMap[$timeStr]['username'] : null,
                    'bookedByName' => ($isBooked && !$isBlocked) ? $bookedMap[$timeStr]['fullName'] : null,
                    'idStudent' => $isBooked ? $bookedMap[$timeStr]['idStudent'] : null
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
        $timeOnly = date('H:i:s', strtotime($request->time));
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $student = DB::table('students')->where('idUser', $user->idUser)->first();

        if (!$student) {
            return response()->json(['message' => 'Este usuario no es un alumno válido'], 403);
        }

        $exists = DB::table('time_slots')
            ->where('idTable', $idTable)
            ->whereTime('start_time', $timeOnly)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Este horario ya está reservado o bloqueado.'], 409);
        }

        $studentBusy = DB::table('time_slots')
            ->where('idStudent', $student->idStudent)
            ->whereTime('start_time', $timeOnly)
            ->exists();

        if ($studentBusy) {
            return response()->json(['message' => 'Ya tienes una entrevista programada a esta hora.'], 409);
        }

        $targetTable = DB::table('company_tables')->where('idTable', $idTable)->first();
        
        if (!$targetTable) {
             return response()->json(['message' => 'La mesa no existe.'], 404);
        }
        
        $targetCompanyId = $targetTable->idCompany;

        $alreadyBookedCompany = DB::table('time_slots')
            ->join('company_tables', 'time_slots.idTable', '=', 'company_tables.idTable')
            ->where('time_slots.idStudent', $student->idStudent)
            ->where('company_tables.idCompany', $targetCompanyId)
            ->exists();

        if ($alreadyBookedCompany) {
            return response()->json(['message' => 'Ya tienes una reserva con esta empresa. Solo se permite una.'], 409);
        }

        DB::table('time_slots')->insert([
            'idTable' => $idTable,
            'start_time' => $bookingTime,
            'idStudent' => $student->idStudent,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json(['message' => 'Reserva confirmada', 'success' => true], 200);
    }

    public function cancel_table_slot(Request $request, $idTable)
    {
        $request->validate([
            'time' => 'required',
            'reason' => 'nullable|string' 
        ]);

        $timeOnly = date('H:i:s', strtotime($request->time));
        $slot = DB::table('time_slots')
            ->where('idTable', $idTable)
            ->whereTime('start_time', $timeOnly)
            ->first();

        if (!$slot) {
            return response()->json(['message' => 'No se encontró la reserva para cancelar'], 404);
        }

        if (!is_null($slot->idStudent)) {
            DB::table('cancellations')->insert([
                'idTable' => $idTable,
                'idStudent' => $slot->idStudent,
                'reservation_time' => $slot->start_time,
                'reason' => $request->reason ?? 'Sin motivo especificado',
                'cancelled_at' => now()
            ]);
        }

        $deleted = DB::table('time_slots')
            ->where('idTable', $idTable)
            ->whereTime('start_time', $timeOnly)
            ->delete();

        if ($deleted) {
            return response()->json(['message' => 'Reserva cancelada y motivo registrado'], 200);
        } else {
            return response()->json(['message' => 'Error al eliminar la reserva'], 500);
        }
    }

    public function block_table_slot(Request $request, $idTable)
    {
        $request->validate([
            'time' => 'required'
        ]);

        $bookingTime = date('Y-m-d H:i:s', strtotime($request->time));
        $timeOnly = date('H:i:s', strtotime($request->time));

        $exists = DB::table('time_slots')
            ->where('idTable', $idTable)
            ->whereTime('start_time', $timeOnly)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Este horario ya está ocupado o bloqueado.'], 409);
        }

        DB::table('time_slots')->insert([
            'idTable' => $idTable,
            'start_time' => $bookingTime,
            'idStudent' => null, 
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json(['message' => 'Horario bloqueado correctamente', 'success' => true], 200);
    }

    public function unblock_table_slot(Request $request, $idTable)
    {
        $request->validate([
            'time' => 'required'
        ]);

        $timeOnly = date('H:i:s', strtotime($request->time));

        $deleted = DB::table('time_slots')
            ->where('idTable', $idTable)
            ->whereTime('start_time', $timeOnly)
            ->whereNull('idStudent') 
            ->delete();

        if ($deleted) {
            return response()->json(['message' => 'Horario desbloqueado correctamente', 'success' => true], 200);
        } else {
            return response()->json(['message' => 'No se encontró el bloqueo para cancelar'], 404);
        }
    }

    public function getMyBookings(Request $request)
    {
        $user = $request->user();
        $student = DB::table('students')->where('idUser', $user->idUser)->first();

        if (!$student) {
            return response()->json([]);
        }

        $bookings = DB::table('time_slots')
            ->where('time_slots.idStudent', $student->idStudent)
            ->join('company_tables', 'time_slots.idTable', '=', 'company_tables.idTable')
            ->join('companies', 'company_tables.idCompany', '=', 'companies.idCompany')
            ->select(
                'time_slots.start_time',
                'time_slots.idTable',
                'companies.idCompany',
                'companies.companyName',
                'company_tables.tableName'
            )
            ->orderBy('time_slots.start_time', 'asc')
            ->get();

        return response()->json($bookings);
    }

    public function toggleVoting(Request $request) {
    // Validamos que venga el estado
    $request->validate(['enabled' => 'required|boolean']);

    // Actualizamos o creamos el ajuste
    DB::table('settings')->updateOrInsert(
        ['key' => 'voting_enabled'],
        ['value' => $request->enabled ? '1' : '0']
    );

    return response()->json(['success' => true, 'is_enabled' => $request->enabled]);
}
}