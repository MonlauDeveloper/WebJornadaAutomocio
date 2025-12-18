<?php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Ubication;
use App\Models\Student;
use App\Models\Specialization;
use App\Models\Team;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    // Mostrar la lista de proyectos
    public function index(Request $request)
    {
        $specializations = \App\Models\Specialization::all();
        $cursos = ['A', 'B', 'C', 'D', 'E', 'F', 'R', 'ONLINE'];
        $ubications = \App\Models\Ubication::whereNotNull('UbicationName')->get(); // Obtener solo ubicaciones con nombre
        $tipos = \App\Models\ProjectType::pluck('name', 'idProjectType');
    
        $query = Project::query()->with(['students', 'ubication']); // Cargar relación con ubicación
    
        // Filtrar por especialización
        if ($request->has('specialization') && $request->specialization) {
            $query->where('idSpecialization', $request->specialization);
        }
    
        // Filtrar por nombre del alumno
        if ($request->has('search') && $request->search) {
            $query->whereHas('students', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('surname1', 'like', '%' . $request->search . '%')
                    ->orWhere('surname2', 'like', '%' . $request->search . '%');
            });
        }
    
        // Filtrar por curso
        if ($request->has('curso') && $request->curso) {
            $query->where('curso', $request->curso);
        }

        // Filtrar por tipo proyecto
        if ($request->has('tipo') && $request->tipo) {
            $query->where('idProjectType', $request->tipo); 
        }
    
        if ($request->has('tipos')) {
            $query->whereIn('idProjectType', $request->tipos);
        }
    
        // Filtrar por número de tribunal
        if ($request->has('numTribunal') && $request->numTribunal) {
            $query->where('numTribunal', $request->numTribunal);
        }
    
        // Filtrar por ubicación
        if ($request->has('idUbication') && $request->idUbication) {
            $query->where('idUbication', $request->idUbication);
        }
    
        $projects = $query->paginate(6);
    
        return view('projects.index', compact('projects', 'specializations', 'cursos', 'ubications', 'tipos'));
    }    

    //EDITAR TRIBUNAL Y UBICACION
    public function updateTribunalUbication(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'idProject' => 'required|exists:projects,idProject',
            'numTribunal' => 'nullable|integer|min:1|max:20',
            'idUbication' => 'nullable|exists:ubications,idUbication'
        ]);
        
        // Buscar el proyecto
        $project = Project::findOrFail($request->idProject);
        
        // Actualizar solo el campo que se ha enviado
        if ($request->has('numTribunal')) {
            $project->numTribunal = $request->numTribunal;
        }
        
        if ($request->has('idUbication')) {
            $project->idUbication = $request->idUbication;
        }
        
        // Guardar los cambios
        $project->save();
    
        // Redirigir de vuelta manteniendo los parámetros de búsqueda
        return redirect()->back()->withInput();
    }
    
    // Mostrar el formulario de creación
    public function create()
    {
        return view('projects.create');
    }

    // Guardar un nuevo proyecto
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'videoFile' => 'nullable|mimes:mp4,mov,avi,wmv|max:20480',
            'pdfURL' => 'nullable|url',
            'moodleURL' => 'nullable|url',
            'abstract' => 'nullable|string',
        ]);

        $photoName = null;
        $videoName = null;

        // Manejar la carga de la imagen
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $photo = $request->file('photo');
            $photoName = time() . '_photo.' . $photo->getClientOriginalExtension();
            $photo->storeAs('photos', $photoName, 'public');
        }

        // Manejar la carga del video
        if ($request->hasFile('videoFile') && $request->file('videoFile')->isValid()) {
            $video = $request->file('videoFile');
            $videoName = time() . '_video.' . $video->getClientOriginalExtension();
            $video->storeAs('videos', $videoName, 'public');
        }

        // Crear un nuevo proyecto con los datos del formulario
        Project::create([
            'title' => $request->title,
            'categoria' => $request->categoria,
            'photoName' => $photoName,
            'videoURL' => $videoName,
            'pdfURL' => $request->pdfURL,
            'moodleURL' => $request->moodleURL,
            'abstract' => $request->abstract,
        ]);

        return redirect()->route('projects.index')->with('success', '¡Proyecto creado!');
    }

    public function show($id)
    {
        $project = Project::with(['ubication', 'students'])->findOrFail($id);
    
        $logo = null;
    
        if ($project->idSpecialization == 5) {
            $team = Team::where('teamName', $project->title)->first();    

            // Si encontramos el equipo, asignamos el logo
            if ($team) {
                $logo = $team->logo;
            }
        }
        // Pasar la información a la vista
        return view('projects.show', compact('project', 'logo'));
    }
    

        
    // Mostrar el formulario de edición
    public function edit(Project $project)
{
    $ubications = Ubication::all();
    $specializations = Specialization::all();
    $projectTypes = \App\Models\ProjectType::all(); 

    return view('projects.edit', compact('project', 'ubications', 'specializations', 'projectTypes'));
}

    public function update(Request $request, Project $project)
    {
        // 1. VALIDACIÓN
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'idSpecialization' => 'required|string|max:255',
            'curso' => 'required|string|max:255',
            'photoName' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'videoURL' => 'nullable|url',
            'pdfURL' => 'nullable|mimes:pdf|max:5120',
            'moodleURL' => 'nullable|url',
            'abstract' => 'nullable|string|max:5000',
            'idUbication' => 'nullable|integer',
            'numTribunal' => 'nullable|integer',
            // NUEVO: Validamos que el tipo exista en la tabla project_types
            'idProjectType' => 'nullable|exists:project_types,idProjectType',
        ]);
    
        // Inicializar variables con los valores actuales (para no perderlos si no se suben nuevos)
        $photoName = $project->photoName;
        $videoURL = $project->videoURL;
        $pdfURL = $project->pdfURL;
        $moodleURL = $project->moodleURL;
    
        // Manejar la carga de la imagen
        if ($request->hasFile('photoName') && $request->file('photoName')->isValid()) {
            $photo = $request->file('photoName');
            $photoName = time() . '_photo.' . $photo->getClientOriginalExtension();
            $photo->storeAs('photos', $photoName, 'public');
        }
    
        // Manejar el enlace de YouTube (Si envían uno nuevo, lo actualizamos)
        if ($request->has('videoURL') && $request->videoURL) {
            $videoURL = $request->videoURL;
        }
    
        // Manejar la carga del PDF
        if ($request->hasFile('pdfURL') && $request->file('pdfURL')->isValid()) {
            $pdf = $request->file('pdfURL');
            $pdfURL = time() . '_pdf.' . $pdf->getClientOriginalExtension();
            $pdf->storeAs('pdfs', $pdfURL, 'public');
        }
    
        // Manejar el enlace de Moodle
        if ($request->has('moodleURL') && $request->moodleURL) {
            $moodleURL = $request->moodleURL;
        }
    
        // 2. ACTUALIZAR CAMPOS
        $project->title = $request->title;
        $project->idSpecialization = $request->idSpecialization;
        $project->curso = $request->curso;
        
        // Asignamos el NUEVO campo de Tipo de Proyecto
        $project->idProjectType = $request->idProjectType; 

        $project->photoName = $photoName;
        $project->videoURL = $videoURL;
        $project->pdfURL = $pdfURL;
        $project->moodleURL = $moodleURL;
        $project->abstract = $request->abstract;
        $project->idUbication = $request->idUbication;
        $project->numTribunal = $request->numTribunal;

        $project->save();
    
        return redirect()->route('projects.index')->with('success', 'Proyecto editado correctamente!');
    }
    

    // Eliminar un proyecto
    public function destroy($idProject)
    {
        $project = Project::find($idProject);
    
        if (!$project) {
            return redirect()->route('projects.index')->with('error', 'Proyecto no encontrado.');
        }
    
        // Eliminar estudiantes asociados
        $students = Student::where('idProject', $idProject)->get();
        foreach ($students as $student) {
            $student->delete();
        }
    
        // Ahora eliminar el proyecto
        $project->delete();
    
        return redirect()->route('projects.index')->with('success', 'Proyecto y estudiantes eliminados exitosamente.');
    }
    

    // Función auxiliar para obtener el valor del CSV o asignar null si no existe
    private function getCsvValue($headerName, $headers, $row) {
        $headerKey = array_search($headerName, $headers);
        return ($headerKey !== false && isset($row[$headerKey])) ? mb_convert_encoding($row[$headerKey], 'UTF-8', 'auto') : null;
    }

    private function normalizarNombreArchivo($nombre)
    {
        $nombre = str_replace(['ñ', 'Ñ'], ['n', 'N'], $nombre);
        $nombre = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $nombre); // quita tildes
        $nombre = preg_replace('/[^A-Za-z0-9 ]/', '', $nombre); // elimina caracteres raros
        $nombre = preg_replace('/\s+/', '_', trim($nombre)); // reemplaza espacios por _
        return $nombre;
    }

      public function subirCsv(Request $request)
    {
        Log::info('Iniciando proceso de subida de CSV');
        $validated = $request->validate([
            'csvFile' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        if ($request->hasFile('csvFile')) {
            Log::info('Archivo CSV detectado');
            $csvFile = $request->file('csvFile');
            $filePath = $csvFile->getRealPath();

            // Leer el archivo y asegurarse de que cada línea esté en UTF-8

            $csvData = array_map(function($line) {
                $encoding = mb_detect_encoding($line, 'UTF-8, ISO-8859-1', true);
                return mb_convert_encoding($line, 'UTF-8', $encoding);
            }, file($filePath));

            // Convertir cada línea a un array de columnas
            $csvData = array_map('str_getcsv', $csvData);

            // Limpiar los encabezados eliminando saltos de línea y espacios adicionales

            $headers = array_map(function($header) {
                return trim(preg_replace('/\s+/', ' ', $header));
            }, str_getcsv($csvData[0][0], ';'));

            unset($csvData[0]); // Eliminar encabezados de los datos

            Log::info('Encabezados del CSV: ', $headers);

            // Verificar que los encabezados contengan las columnas esperadas

            $requiredHeaders = [
                'Correo electrónico', 'El teu nom és:', 'El teu 1r cognom és:',
                'El meu grup actual és:', 'Títol del projecte'
            ];

            foreach ($requiredHeaders as $header) {
                if (!in_array($header, $headers)) {
                    Log::error("El archivo CSV no contiene la columna requerida: $header");
                    return redirect()->back()->with('error', "El archivo CSV no contiene la columna requerida: $header");
                }
            }

            foreach ($csvData as $row) {
                $row = array_map('trim', str_getcsv($row[0], ';'));

                // Asegurarse de que los campos estén correctamente codificados en UTF-8
                $email = $this->getCsvValue('Correo electrónico', $headers, $row);
                $nombre = $this->getCsvValue('El teu nom és:', $headers, $row);
                $apellido1 = $this->getCsvValue('El teu 1r cognom és:', $headers, $row);
                $apellido2 = $this->getCsvValue('El teu 2n cognom és:', $headers, $row);
                $curso = $this->getCsvValue('El meu grup actual és:', $headers, $row);
                $modalidad = $this->getCsvValue('Treball és:', $headers, $row);
                $titulo = $this->getCsvValue('Títol del projecte', $headers, $row);
                $trabajo = $this->getCsvValue('El treball és:', $headers, $row);
                $equipoString = $this->getCsvValue("Monlautech - Escull l'equip del que formes part.", $headers, $row);
                $descripcion = $this->getCsvValue('Realitza una petita descripció del que has fet al teu projecte. (UTILITZA VOCAVULARI TÈCNIC)', $headers, $row);
                $descripcion = preg_replace('/\s+/', ' ', $descripcion); // Reemplaza saltos de línea, tabulaciones, múltiples espacios por un solo espacio
                $descripcion = str_replace(["\r", "\n"], ' ', $descripcion);

                $nombreFoto = $this->normalizarNombreArchivo("{$nombre} {$apellido1} {$apellido2}");
                $photoUrl = "https://res.cloudinary.com/monlaujornadas/image/upload/FotosOrla2025/{$nombreFoto}.jpg";

                // Verificar si el proyecto es práctic
                $trabajo = trim(strtolower($trabajo));
                if (strpos($trabajo, 'teòric') !== false) {
                    Log::info('Proyecto teórico, saltando fila');
                    continue; // Si es teórico, saltar a la siguiente fila
                }

                if($modalidad == 'Monlautech'){
                    $idSpecialization = 5;
                    preg_match('/Equip (\d+)/', $equipoString, $matches);
                    $equipoId = isset($matches[1]) ? $matches[1] : null;
                    $titulo = $equipoString;
                } else {

                    // Determinar especialización y curso
                    $specializations = [
                        '2CA-CM' => 1, '2CA-CS' => 4, '2CB-CM' => 1, '2CB-CS' => 4, '2CC-CM' => 1, '2CC-CS' => 4,
                        '2CD-CM' => 1, '2CD-CS' => 4, '2CE-CM' => 1, '2CE-CS' => 4, '2CF-CM' => 1, '2CF-CS' => 4,
                        '2CMA-CM' => 2, '2CMA-CM GM Motos' => 2, '2CR-CM' => 1, '2CR-CS' => 4, '2XA-CM' => 3, '2XB-CM' => 3, 'ONLINE' => 4
                    ];
                    $idSpecialization = $specializations[$curso] ?? 5; // Si no coincide, asignar MonlauTech (id 5)
                }
                $moodleUrls = [
                    '2CA-CS' => 'https://moodlelm.monlau.com/mod/assign/view.php?id=30056',
                    '2CB-CS' => 'https://moodlelm.monlau.com/mod/assign/view.php?id=40155',
                    '2CC-CS' => 'https://moodlelm.monlau.com/mod/assign/view.php?id=40173',
                    '2CD-CS' => 'https://moodlelm.monlau.com/mod/assign/view.php?id=40249',
                    '2CE-CS' => 'https://moodlelm.monlau.com/mod/assign/view.php?id=40459',
                    '2CF-CS' => null,
                    '2CR-CS' => 'https://moodlelm.monlau.com/mod/assign/view.php?id=41440',
                    'ONLINE' => null,
                    '2CA-CM' => 'https://moodlelm.monlau.com/mod/assign/view.php?id=27831',
                    '2CB-CM' => 'https://moodlelm.monlau.com/mod/assign/view.php?id=27831',
                    '2CC-CM' => 'https://moodlelm.monlau.com/mod/assign/view.php?id=27831',
                    '2CD-CM' => 'https://moodlelm.monlau.com/mod/assign/view.php?id=27831',
                    '2CE-CM' => 'https://moodlelm.monlau.com/mod/assign/view.php?id=27831',
                    '2CF-CM' => 'https://moodlelm.monlau.com/mod/assign/view.php?id=27831',
                    '2CR-CM' => 'https://moodlelm.monlau.com/mod/assign/view.php?id=27831',
                    '2CMA-CM' => 'https://moodlelm.monlau.com/mod/assign/view.php?id=31464',
                    '2CMA-CM GM Motos' => 'https://moodlelm.monlau.com/mod/assign/view.php?id=31464',
                    '2XA-CM' => 'https://moodlelm.monlau.com/mod/assign/view.php?id=31003',
                    '2XB-CM' => 'https://moodlelm.monlau.com/mod/assign/view.php?id=39380',
                ];

                $moodleURL = isset($moodleUrls[$curso]) ? $moodleUrls[$curso] : null;

                // Determinar el curso basado en el valor de $curso
                if ($curso === 'ONLINE') {
                    $cursoFormatted = 'ONLINE';
                } else {
                    // Extraer el tercer carácter de especialización si el curso no es ONLINE
                    $cursoFormatted = substr($curso, 2, 1);
                }

                // Crear el usuario
                $user = \App\Models\User::updateOrCreate(
                    ['email' => strtolower($email)], // Buscar usuario por email
                    [
                        'username' => strtolower(str_replace(" ", "", $nombre . $apellido1 . $apellido2)),
                        'password' => bcrypt('Monlau2025'),
                        'status' => 'approved',
                        'idRole' => 3,
                    ]
                );

                if (!$user) {
                    Log::error('Error al crear el usuario');
                    return redirect()->back()->with('error', 'Error al crear el usuario.');
                }

                Log::info('Usuario creado: ', ['id' => $user->idUser]);

                // Crear proyecto
                $project = \App\Models\Project::updateOrCreate(
                ['title' => $titulo],
                [
                    'idSpecialization' => $idSpecialization,
                    'curso' => $cursoFormatted,
                    'abstract' => $descripcion,
                    'moodleURL' => $moodleURL,
                ]);

                if (!$project) {
                    Log::error('Error al crear el proyecto');
                    return redirect()->back()->with('error', 'Error al crear el proyecto.');
                }

                Log::info('Proyecto creado: ', ['id' => $project->idProject]);

                // Crear estudiante
                $student = \App\Models\Student::updateOrCreate(
                ['idUser' => $user->idUser],
                [
                    'name' => ucfirst($nombre),
                    'surname1' => ucfirst($apellido1),
                    'surname2' => !empty($apellido2) ? ucfirst($apellido2) : null,
                    'idSpecialization' => $idSpecialization,
                    'curso' => $cursoFormatted,
                    'idTeam' => !empty($equipoId) ? $equipoId : null,
                    'idProject' => $project->idProject,
                    'photoName' => $photoUrl,
                ]);

                if (!$student) {
                    Log::error('Error al crear el Estudiante');
                    return redirect()->back()->with('error', 'Error al crear el Estudiante.');
                }

                // Actualizar el cvLink del estudiante
                $student->cvLink = 'https://jornadaautomocion.alumnes-monlau.com/pdfVer/' . $student->idStudent;
                $student->save();

                Log::info('Estudiante creado: ', ['id' => $student->idStudent]);
            }

            Log::info('Proceso de subida de CSV completado');
            return redirect()->route('projects.index')->with('success', 'CSV procesado y datos guardados correctamente.');
        }

        Log::error('No se pudo procesar el archivo CSV');
        return redirect()->back()->with('error', 'No se pudo procesar el archivo CSV.');
    }
}