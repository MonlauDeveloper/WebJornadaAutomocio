<?php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Ubication;
use App\Models\Student;
use App\Models\Specialization;
use App\Models\Team;
use App\Models\ProjectImage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    // Mostrar la lista de proyectos
    public function index(Request $request)
    {
        $specializations = \App\Models\Specialization::all();
        $cursos = ['A', 'B', 'C', 'D', 'E', 'F', 'R', 'ONLINE'];
        $ubications = \App\Models\Ubication::whereNotNull('UbicationName')->get();
        $tipos = \App\Models\ProjectType::pluck('name', 'idProjectType');

        $query = Project::query()->with(['students', 'ubication']);

        // 1. Filtrar por especialización
        if ($request->filled('specialization')) {
            $query->where('idSpecialization', $request->specialization);
        }

        // 2. BUSCADOR (Corregido para ser acumulativo)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                // Busca por título del proyecto
                $q->where('title', 'like', '%' . $search . '%')
                    // O busca por nombre/apellidos de los alumnos
                    ->orWhereHas('students', function ($sq) use ($search) {
                        $sq->where('name', 'like', '%' . $search . '%')
                            ->orWhere('surname1', 'like', '%' . $search . '%')
                            ->orWhere('surname2', 'like', '%' . $search . '%');
                    });
            });
        }

        // 3. Filtrar por curso
        if ($request->filled('curso')) {
            $query->where('curso', $request->curso);
        }

        // 4. Filtrar por tipo proyecto
        if ($request->filled('tipo')) {
            $query->where('idProjectType', $request->tipo);
        }

        // 5. Filtrar por número de tribunal
        if ($request->filled('numTribunal')) {
            $query->where('numTribunal', $request->numTribunal);
        }

        // 6. Filtrar por ubicación
        if ($request->filled('idUbication')) {
            $query->where('idUbication', $request->idUbication);
        }

        $projects = $query->paginate(6)->withQueryString(); // Importante: mantiene los filtros al cambiar de página

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
            'abstract' => 'nullable|string|max:1500',
            'idUbication' => 'nullable|integer',
            'numTribunal' => 'nullable|integer',
            'idProjectType' => 'nullable|exists:project_types,idProjectType',
            // Validación de la nueva imagen
            'new_project_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'new_image_fase' => 'nullable|string',
            'new_image_orden' => 'nullable|integer',
            // Validación de las descripciones (Array)
            'image_descriptions' => 'nullable|array',
        ]);

        // Actualizar datos básicos
        $project->title = $request->title;
        $project->idSpecialization = $request->idSpecialization;
        $project->curso = $request->curso;
        $project->idProjectType = $request->idProjectType;
        $project->videoURL = $request->videoURL;
        $project->moodleURL = $request->moodleURL;
        $project->abstract = $request->abstract;
        $project->idUbication = $request->idUbication;
        $project->numTribunal = $request->numTribunal;

        // Manejo de foto principal y PDF
        if ($request->hasFile('photoName') && $request->file('photoName')->isValid()) {
            $photoName = time() . '_photo.' . $request->file('photoName')->getClientOriginalExtension();
            $request->file('photoName')->storeAs('photos', $photoName, 'public');
            $project->photoName = $photoName;
        }

        if ($request->hasFile('pdfURL') && $request->file('pdfURL')->isValid()) {
            $pdfName = time() . '_pdf.' . $request->file('pdfURL')->getClientOriginalExtension();
            $request->file('pdfURL')->storeAs('pdfs', $pdfName, 'public');
            $project->pdfURL = $pdfName;
        }

        $project->save();

        // --- GUARDAR DESCRIPCIONES DE IMÁGENES EXISTENTES ---
        if ($request->has('image_descriptions')) {
            foreach ($request->image_descriptions as $imageId => $description) {
                // Actualizamos la descripción en la tabla pivot/relacionada
                \DB::table('project_images')
                    ->where('id', $imageId)
                    ->update(['description' => $description]);
            }
        }

        // --- LÓGICA DE SUBIDA CON LÍMITE DE 6 ---
        if ($request->hasFile('new_project_image') && $request->file('new_project_image')->isValid()) {

            // CAPAR A 6 FOTOS MÁXIMO
            $totalActual = $project->images()->count();
            if ($totalActual >= 6) {
                return redirect()->back()->with('error', 'Límite de 6 imágenes alcanzado. Borra una para subir otra.');
            }

            $faseDestino = $request->new_image_fase;

            // Sustitución si no es procedimiento
            if ($faseDestino !== 'procedimiento') {
                $fotoAntigua = $project->images()->where('fase', $faseDestino)->first();
                if ($fotoAntigua) {
                    if (\Storage::disk('public')->exists('project_steps/' . $fotoAntigua->file_path)) {
                        \Storage::disk('public')->delete('project_steps/' . $fotoAntigua->file_path);
                    }
                    $fotoAntigua->delete();
                }
            }

            // Guardar la nueva
            $image = $request->file('new_project_image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('project_steps', $fileName, 'public');

            $project->images()->create([
                'idProject' => $project->idProject,
                'file_path' => $fileName,
                'fase' => $faseDestino,
                'orden' => $request->new_image_orden ?? 1,
            ]);
        }

        return redirect()->back()->with('success', '¡Proyecto y ficha técnica actualizados!');
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
    private function getCsvValue($headerName, $headers, $row)
    {
        // Normalizamos el nombre que buscamos: minúsculas y solo letras/números
        $search = preg_replace('/[^a-z0-9]/', '', mb_strtolower($headerName, 'UTF-8'));

        foreach ($headers as $key => $header) {
            // Normalizamos cada cabecera del CSV de la misma forma
            $cleanHeader = preg_replace('/[^a-z0-9]/', '', mb_strtolower($header, 'UTF-8'));

            if ($cleanHeader === $search) {
                return (isset($row[$key]) && $row[$key] !== '') ? $row[$key] : null;
            }
        }
        return null;
    }

    // Busca el valor en la fila comparando nombres de columna de forma "limpia"
    private function obtenerValorDeFila($nombreBuscado, $headersLimpios, $row)
    {
        $search = $this->limpiarTextoParaComparar($nombreBuscado);
        $index = array_search($search, $headersLimpios);

        return ($index !== false && isset($row[$index])) ? trim($row[$index]) : null;
    }

    // Quita todo lo que no sean letras o números para comparar cabeceras sin errores
    private function limpiarTextoParaComparar($texto)
    {
        $texto = mb_strtolower($texto, 'UTF-8');
        // Eliminar tildes
        $texto = str_replace(['á', 'é', 'í', 'ó', 'ú', 'à', 'è', 'ì', 'ò', 'ù'], ['a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u'], $texto);
        // Eliminar cualquier cosa que no sea a-z o 0-9
        return preg_replace('/[^a-z0-9]/', '', $texto);
    }

    private function normalizarNombreArchivo($nombre)
    {
        if (empty($nombre))
            return "sin_nombre";
        $nombre = mb_strtolower($nombre, 'UTF-8');
        $nombre = str_replace(['ñ', 'Ñ'], ['n', 'N'], $nombre);
        $mapa = ['á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'à' => 'a', 'è' => 'e', 'ì' => 'i', 'ò' => 'o', 'ù' => 'u'];
        $nombre = strtr($nombre, $mapa);
        $nombre = preg_replace('/[^a-z0-9 ]/', '', $nombre);
        return preg_replace('/\s+/', '_', trim($nombre));
    }

    public function subirCsv(Request $request)
    {

        set_time_limit(0);
        Log::info('Iniciando proceso de subida de CSV - Incluyendo Teóricos');
        $request->validate(['csvFile' => 'required|file|max:5120']);

        if ($request->hasFile('csvFile')) {
            $path = $request->file('csvFile')->getRealPath();

            if (($handle = fopen($path, "r")) !== FALSE) {
                // 1. Leer y limpiar cabeceras
                $rawHeaders = fgetcsv($handle, 0, ";");
                if (!$rawHeaders)
                    return redirect()->back()->with('error', 'Archivo vacío.');

                $headers = array_map(function ($h) {
                    return $this->limpiarTextoParaComparar($h);
                }, $rawHeaders);

                $importados = 0;

                // 2. Procesar filas
                while (($row = fgetcsv($handle, 0, ";")) !== FALSE) {

                    // Mapeo flexible de columnas
                    $email = $this->obtenerValorDeFila('Correo electrónico', $headers, $row);
                    $titulo = $this->obtenerValorDeFila('Títol del projecte', $headers, $row);
                    $nombre = $this->obtenerValorDeFila('El teu nom és:', $headers, $row) ?? $this->obtenerValorDeFila('Nombre', $headers, $row);
                    $apellido1 = $this->obtenerValorDeFila('El teu 1r cognom és:', $headers, $row);
                    $apellido2 = $this->obtenerValorDeFila('El teu 2n cognom és:', $headers, $row);
                    $curso = $this->obtenerValorDeFila('El meu grup actual és:', $headers, $row);
                    $desc = $this->obtenerValorDeFila('Realitza una petita descripció del que has fet al teu projecte. (UTILITZA VOCAVULARI TÈCNIC)', $headers, $row);

                    // --- PROTECCIÓN CONTRA FILAS VACÍAS ---
                    if (empty($titulo))
                        continue;

                    // --- LÓGICA DE CURSO Y ESPECIALIZACIÓN ---
                    $specializationsMap = [
                        '2CA-CM' => 1,
                        '2CA-CS' => 4,
                        '2CB-CM' => 1,
                        '2CB-CS' => 4,
                        '2CC-CM' => 1,
                        '2CC-CS' => 4,
                        '2CD-CM' => 1,
                        '2CD-CS' => 4,
                        '2CE-CM' => 1,
                        '2CE-CS' => 4,
                        '2CF-CM' => 1,
                        '2CF-CS' => 4,
                        '2CMA-CM' => 2,
                        '2CMA-CM GM Motos' => 2,
                        '2CR-CM' => 1,
                        '2CR-CS' => 4,
                        '2XA-CM' => 3,
                        '2XB-CM' => 3,
                        'ONLINE' => 4
                    ];
                    $idSpecialization = $specializationsMap[$curso] ?? 1;
                    $cursoFormatted = ($curso === 'ONLINE') ? 'ONLINE' : substr($curso, 2, 1);

                    try {
                        // 1. Crear Proyecto (Ahora entran Prácticos y Teóricos)
                        $project = \App\Models\Project::updateOrCreate(
                            ['title' => mb_convert_encoding($titulo, 'UTF-8', 'auto')],
                            [
                                'idSpecialization' => $idSpecialization,
                                'curso' => $cursoFormatted ?: 'X',
                                'abstract' => mb_convert_encoding($desc ?? '', 'UTF-8', 'auto'),
                            ]
                        );

                        // 2. Crear Usuario y Estudiante
                        if ($email && $nombre) {
                            $user = \App\Models\User::updateOrCreate(
                                ['email' => strtolower($email)],
                                [
                                    'username' => strtolower(str_replace(" ", "", $nombre . $apellido1)),
                                    'password' => bcrypt('Monlau2025'),
                                    'idRole' => 3,
                                    'status' => 'approved'
                                ]
                            );

                            $student = \App\Models\Student::updateOrCreate(
                                ['idUser' => $user->idUser],
                                [
                                    'name' => ucfirst($nombre),
                                    'surname1' => ucfirst($apellido1),
                                    'surname2' => $apellido2,
                                    'idProject' => $project->idProject,
                                    'idSpecialization' => $idSpecialization,
                                    'curso' => $cursoFormatted,
                                    'photoName' => "https://res.cloudinary.com/monlaujornadas/image/upload/FotosOrla2025/" . $this->normalizarNombreArchivo("$nombre $apellido1 $apellido2") . ".jpg"
                                ]
                            );
                            $student->cvLink = 'https://jornadaautomocion.alumnes-monlau.com/pdfVer/' . $student->idStudent;
                            $student->save();
                        }
                        $importados++;
                    } catch (\Exception $e) {
                        Log::error("Error en importación: " . $e->getMessage());
                    }
                }
                fclose($handle);
            }
            return redirect()->route('projects.index')->with('success', "¡Importación completada! Se han generado $importados proyectos (incluyendo teóricos).");
        }
        return redirect()->back()->with('error', 'Error al procesar el archivo.');
    }


    public function generatePdf($id)
    {


        // 1. Buscamos el proyecto con sus imágenes
        $project = Project::with(['students', 'images', 'specialization'])->findOrFail($id);

        // 2. Filtramos por fase (esto ya lo tienes)
        $fotoHeader = $project->images->where('fase', 'header')->first();
        $fotoInitial = $project->images->where('fase', 'initial')->first();
        $fotoFinal = $project->images->where('fase', 'final')->first();
        $fotosProcedimiento = $project->images->where('fase', 'procedimiento')->sortBy('orden');

        // 3. Preparamos el array $data (con public_path como hablamos antes)
        $data = [
            'project' => $project,
            'students' => $project->students,
            'fotoHeader' => $fotoHeader ? public_path('storage/project_steps/' . $fotoHeader->file_path) : null,
            'fotoInitial' => $fotoInitial ? public_path('storage/project_steps/' . $fotoInitial->file_path) : null,
            'fotoFinal' => $fotoFinal ? public_path('storage/project_steps/' . $fotoFinal->file_path) : null,
            'fotosProcedimiento' => $fotosProcedimiento->map(function ($img) {
                return public_path('storage/project_steps/' . $img->file_path);
            })
        ];

        // 4. GENERACIÓN DEL PDF CON LAS OPCIONES DE IMAGEN
        $pdf = Pdf::loadView('pdf.proyecto', $data)
            ->setPaper('a4', 'portrait')
            ->setOption([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true, // Permite cargar imágenes
                'defaultFont' => 'sans-serif'
            ]);

        return $pdf->stream('Proyecto_' . $id . '.pdf');
    }
    public function destroyImage($id)
    {
        $image = ProjectImage::findOrFail($id);

        // 1. Borrar el archivo físico de la carpeta storage/app/public/project_steps
        if (Storage::disk('public')->exists('project_steps/' . $image->file_path)) {
            Storage::disk('public')->delete('project_steps/' . $image->file_path);
        }

        // 2. Eliminar el registro de la base de datos
        $image->delete();

        return redirect()->back()->with('success', 'Imagen eliminada correctamente.');
    }

    // Método para eliminar solo la foto principal del proyecto
    public function destroyPhoto(Project $project)
{
    if ($project->photoName && \Storage::disk('public')->exists('photos/' . $project->photoName)) {
        \Storage::disk('public')->delete('photos/' . $project->photoName);
    }

    $project->photoName = 'por_defecto/proyecto_default.png';
    $project->save();

    return redirect()->back()->with('success', 'Foto eliminada. Se ha restaurado la imagen por defecto.');
}
}

