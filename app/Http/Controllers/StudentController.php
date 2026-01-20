<?php

namespace App\Http\Controllers;
use App\Actions\Fortify\UpdateUserPassword;
use App\Models\Student;
use App\Models\User;
use App\Models\Education;
use App\Models\Language;
use App\Models\WorkExperience;
use App\Models\Contact;
use App\Models\Specialization;
use App\Models\Ubication;
use App\Models\Project;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Spatie\Browsershot\Browsershot;
use Barryvdh\DomPDF\Facade\Pdf;


class StudentController extends Controller
{
    public function index(Request $request)
    {
        $specializations = \App\Models\Specialization::all(); // Obtener todas las especializaciones
        $cursos = ['A', 'B', 'C', 'D', 'E', 'F', 'R', 'ONLINE']; // Lista de cursos disponibles

        $query = Student::query();

        // Filtrar por especialización, si se ha seleccionado una
        if ($request->has('specialization') && $request->specialization) {
            $query->where('idSpecialization', $request->specialization);
        }

        // Filtrar por nombre, si se ha proporcionado un término de búsqueda
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('surname1', 'like', '%' . $request->search . '%')
                    ->orWhere('surname2', 'like', '%' . $request->search . '%');
            });
        }

        // Filtrar por curso, si se ha seleccionado uno
        if ($request->has('curso') && $request->curso) {
            $query->where('curso', $request->curso);
        }

        // Determinar el número de elementos por página según la vista seleccionada
        $perPage = $request->has('view') && $request->view === 'list' ? 12 : 6;

        $students = $query->with('specialization', 'team')->paginate($perPage);

        return view('students.index', compact('students', 'specializations', 'cursos'));
    }

    private function normalizarNombreArchivo($nombre)
    {
        $nombre = str_replace(['ñ', 'Ñ'], ['n', 'N'], $nombre);
        $nombre = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $nombre); // quita tildes
        $nombre = preg_replace('/[^A-Za-z0-9 ]/', '', $nombre); // elimina caracteres raros
        $nombre = preg_replace('/\s+/', '_', trim($nombre)); // reemplaza espacios por _
        return $nombre;
    }

    public function create()
    {
        // Obtener especializaciones, ubicaciones y proyectos
        $specializations = Specialization::all();
        $projects = Project::all();
        $ubications = Ubication::all();

        return view('students.create', compact('specializations', 'projects', 'ubications'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname1' => 'required|string|max:255',
            'surname2' => 'nullable|string|max:255',
            'idSpecialization' => 'required|integer|exists:specializations,idSpecialization',
            'course' => 'required|string|in:A,B,C,D,E,F,R,ONLINE',
            'team' => 'nullable|string|max:255',
            'idProject' => 'nullable|string|max:255',
            'project_title' => 'nullable|required_if:idProject,new_project|string|max:255',
            'project_specialization' => 'nullable|required_if:idProject,new_project|integer|exists:specializations,idSpecialization',
            'project_course' => 'nullable|required_if:idProject,new_project|string|in:A,B,C,D,E,F,R,ONLINE',
            'project_ubication' => 'nullable|integer|exists:ubications,idUbication',
            'project_numTribunal' => 'nullable|integer|between:1,20',
        ]);

        // Si se seleccionó "Crear proyecto nuevo", crear el proyecto
        if ($request->idProject === 'new_project') {
            $project = Project::create([
                'title' => $validated['project_title'],
                'idSpecialization' => $validated['project_specialization'],
                'curso' => $validated['project_course'],
                'idUbication' => $validated['project_ubication'] ?? null,
                'numTribunal' => $validated['project_numTribunal'] ?? null,
            ]);
            $validated['idProject'] = $project->idProject;
        }

        // Generar el username
        $name = $validated['name'];
        $surname1 = $validated['surname1'];
        $surname2 = $validated['surname2'] ?? ''; // Si no hay apellido2, es una cadena vacía

        $accents = ["á", "à", "é", "è", "ì", "í", "ó", "ò", "ù", "ú", "À", "Á", "É", "È", "Í", "Ì", "Ó", "Ò", "Ù", "Ú", "Ñ", "ñ"];
        $accentsReplacement = ["a", "a", "e", "e", "i", "i", "o", "o", "u", "u", "A", "A", "E", "E", "I", "I", "O", "O", "U", "U", "N", "n"];

        // Obtén el nombre y apellidos tal cual
        $nombre = $name; // No reemplazamos acentos
        $apellido1 = $surname1;
        $apellido2 = $surname2;

        $nombreFoto = $this->normalizarNombreArchivo("{$nombre} {$apellido1} {$apellido2}");
        $photoUrl = "https://res.cloudinary.com/monlaujornadas/image/upload/FotosOrla2025/{$nombreFoto}.jpg";

        // Genera el username con los nombres y apellidos sin acentos
        $nombreSinAcentos = str_replace($accents, $accentsReplacement, $nombre);
        $apellido1SinAcentos = str_replace($accents, $accentsReplacement, $apellido1);
        $apellido2SinAcentos = str_replace($accents, $accentsReplacement, $apellido2);

        $username = ucfirst($nombreSinAcentos)
            . ucfirst(substr($apellido1SinAcentos, 0, 3))
            . ucfirst(substr($apellido2SinAcentos, 0, 3));

        // Crear el email
        $email = strtolower(Str::slug($username)) . '@campus.monlau.com';

        // Crear el usuario (User)
        $user = User::create([
            'username' => $username,
            'email' => $email,
            'password' => bcrypt('Monlau2025'),
            'status' => 'approved',
            'idRole' => 3, // Establecer idRole como 3
        ]);
        if (!$user) {
            Log::error('Error al crear el usuario');
            return redirect()->back()->with('error', 'Error al crear el usuario.');
        }

        Log::info('Usuario creado: ', ['id' => $user->id]);

        // Crear el estudiante (Student)
        $student = Student::create([
            'name' => ucfirst($name),
            'surname1' => ucfirst($surname1),
            'surname2' => ucfirst($surname2),
            'idSpecialization' => $validated['idSpecialization'],
            'curso' => $validated['course'],
            'idTeam' => $validated['team'] ?? null,
            'idProject' => $validated['idProject'] ?? null,
            'idUser' => $user->idUser,
            'photoName' => $photoUrl,
        ]);

        if (!$student) {
            Log::error('Error al crear el estudiante');
            return redirect()->back()->with('error', 'Error al crear el estudiante.');
        }

        $student->cvLink = 'https://jornadaautomocion.alumnes-monlau.com/pdfVer/' . $student->idStudent;
        $student->save();

        // Enviar éxito
        Log::info('Estudiante creado: ', ['id' => $student->id]);
        return redirect()->route('students.index')->with('success', 'Estudiante creado correctamente.');
    }


    public function show($idStudent)
    {
        $student = Student::with(['team', 'specialization', 'project'])->findOrFail($idStudent);

        return view('students.show', compact('student'));
    }

    public function edit($idStudent)
    {
        // Buscar el estudiante por su ID
        $student = Student::findOrFail($idStudent);

        // Obtener las especializaciones para el select
        $specializations = Specialization::all(); // Ajusta esto si necesitas un filtro específico
        $projects = Project::all(); // Ajusta esto si necesitas un filtro específico

        // Retornar la vista con los datos del estudiante
        return view('students.edit', compact('student', 'specializations', 'projects'));
    }

    public function update(Request $request, $idStudent)
    {
        // Buscar el estudiante por su ID
        $student = Student::findOrFail($idStudent);

        // Validación de datos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname1' => 'required|string|max:255',
            'surname2' => 'required|string|max:255',
            'idProject' => 'required|exists:projects,idProject',
            'introduction' => 'nullable|string|max:5000',
            'cvLink' => 'nullable|string|max:255',
            'isTeamLeader' => 'nullable|boolean',
            'idSpecialization' => 'required|exists:specializations,idSpecialization',
            'curso' => 'nullable|string|max:7',  // Ajusta el tamaño si es necesario
            'idTeam' => 'nullable|integer|exists:teams,idTeam', // Si necesitas validación para el equipo
            'photoName' => 'nullable|string|max:5000',  // Foto opcional
        ]);

        // Actualizamos el resto de los campos
        $student->name = $request->name;
        $student->surname1 = $request->surname1;
        $student->surname2 = $request->surname2;
        $student->idProject = $request->idProject;
        $student->introduction = $request->introduction;
        $student->cvLink = $request->cvLink;
        $student->isTeamLeader = $request->has('isTeamLeader') ? 1 : 0;
        $student->idSpecialization = $request->idSpecialization;
        $student->curso = $request->curso;
        $student->idTeam = $request->idTeam;
        $student->photoName = $request->photoName;

        // Guardamos los cambios
        $student->save();

        // Redirigir a la vista de detalles del estudiante con un mensaje de éxito
        return redirect()->route('students.show', $student->idStudent)
            ->with('success', 'Estudiante actualizado correctamente.');
    }

    public function destroy($idStudent)
    {
        // Buscar el estudiante por su ID
        $student = Student::findOrFail($idStudent);

        // Eliminar el estudiante
        $student->delete();

        // Redirigir a la lista de estudiantes con un mensaje de éxito
        return redirect()->route('students.index')
            ->with('success', 'Estudiante eliminado correctamente.');
    }

    public function myProject()
    {
        $student = auth()->user()->student; // Obtener el estudiante autenticado

        if (!$student) {
            dd(auth()->user(), 'Estudiante no encontrado');
            return redirect()->route('dashboard')->with('error', 'No se ha encontrado el estudiante.');
        }

        $project = $student->project; // Obtener el proyecto del estudiante

        if (!$project) {
            return redirect()->back()->with('error', 'No tienes un proyecto asignado.');
        }

        // Verificar si algún campo del proyecto está vacío o nulo
        $projectIncomplete = $project->photoName === null || $project->videoURL === null || $project->pdfURL === null || $project->abstract === null;

        return view('students.myProject', compact('project', 'projectIncomplete'));
    }

    public function updateProject(Request $request)
    {
        $student = auth()->user()->student; // Obtener el estudiante autenticado
        $project = $student->project;

        if (!$project) {
            return redirect()->back()->with('error', 'No tienes un proyecto asignado.');
        }

        // Validación
        $validated = $request->validate([
            'photoName' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'videoURL' => 'nullable|url|starts_with:https://www.youtube.com/embed/',
            'pdfURL' => 'nullable|mimes:pdf|max:5120',
            'abstract' => 'nullable|string|max:5000',
        ]);

        // Inicializar variables para evitar errores
        $photoName = $project->photoName;
        $videoURL = $project->videoURL;
        $pdfURL = $project->pdfURL;

        // Manejar la carga de la imagen con conversión a WebP
        if ($request->hasFile('photoName') && $request->file('photoName')->isValid()) {
            $photo = $request->file('photoName');

            // Crear el ImageManager
            $imgManager = new ImageManager(new Driver());

            // Leer la imagen original
            $image = $imgManager->read($photo->getPathname());

            // Obtener dimensiones originales
            $originalWidth = $image->width();
            $originalHeight = $image->height();

            // Reducir el tamaño en un 80%
            $newWidth = intval($originalWidth * 0.8);
            $newHeight = intval($originalHeight * 0.8);

            // Redimensionar la imagen manteniendo la proporción
            $image->resize($newWidth, $newHeight);

            // Nombre del archivo convertido a WebP
            $photoName = time() . '_photo.webp';

            // Guardar la imagen redimensionada en storage/app/public/photos
            $image->save(storage_path('app/public/photos/' . $photoName), 80, 'webp');
        }

        // Manejar el enlace de YouTube
        if ($request->has('videoURL') && $request->videoURL) {
            $videoURL = $request->videoURL;
        }

        // Manejar la carga del PDF
        if ($request->hasFile('pdfURL') && $request->file('pdfURL')->isValid()) {
            $pdf = $request->file('pdfURL');
            $pdfURL = time() . '_pdf.' . $pdf->getClientOriginalExtension();
            $pdf->storeAs('pdfs', $pdfURL, 'public');
        }

        // Actualizar campos del proyecto
        $project->photoName = $photoName;
        $project->videoURL = $videoURL;
        $project->pdfURL = $pdfURL;
        $project->abstract = $request->abstract;

        $project->save();

        return redirect()->route('students.myProject')->with('success', 'Proyecto actualizado correctamente.');
    }


    public function myProfile()
    {
        $student = auth()->user()->student;

        if (!$student) {
            return redirect()->route('dashboard')->with('error', 'No se ha encontrado el perfil del estudiante.');
        }

        return view('students.myProfile', compact('student'));
    }

    public function updateProfile(Request $request)
    {
        $student = auth()->user()->student;

        if (!$student) {
            return redirect()->back()->with('error', 'No se ha encontrado el perfil del estudiante.');
        }


        // Validación de datos
        $request->validate([
            'education.*' => 'nullable|string|max:255',
            'languages.*' => 'nullable|string|max:255',
            'work_experience.*' => 'nullable|string|max:255',
            'introduction' => 'nullable|string|max:5000',
            'contact.*' => 'nullable|string|max:255',
        ]);

        if ($student) {
            $student->cvLink = 'https://jornadaautomocion.alumnes-monlau.com/pdfVer/' . $student->idStudent;
            $student->introduction = $request->introduction;
            $student->save();
        }

        // Limpiar datos anteriores
        $student->educations()->delete();
        $student->languages()->delete();
        $student->workExperiences()->delete();
        $student->contacts()->delete();

        // Guardar nueva educación
        if ($request->filled('education')) {
            foreach ($request->education as $education) {
                if (!empty($education)) {
                    $student->educations()->create(['education' => $education]);
                }
            }
        }

        // Guardar nuevos idiomas
        if ($request->filled('languages')) {
            foreach ($request->languages as $language) {
                if (!empty($language)) {
                    $student->languages()->create(['language' => $language]);
                }
            }
        }

        // Guardar nueva experiencia laboral
        if ($request->filled('work_experience')) {
            foreach ($request->work_experience as $experience) {
                if (!empty($experience)) {
                    $student->workExperiences()->create(['work_experience' => $experience]);
                }
            }
        }

        // Guardar nuevos contactos
        if ($request->filled('contact')) {
            foreach ($request->contact as $contact) {
                if (!empty($contact)) {
                    $student->contacts()->create(['contact' => $contact]);
                }
            }
        }

        return redirect()->route('students.myProfile')->with('success', 'Perfil actualizado correctamente.');
    }

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

        return redirect()->route('students.myProfile')->with('success', 'Contraseña actualizada correctamente.');
    }


    public function verPDF($idStudent)
    {
        $student = Student::with(['team', 'specialization', 'project'])->findOrFail($idStudent);
    
        // Intenta cargar la imagen
        try {
            $imageUrl = $student->photoName ?? 'https://jornadaautomocion.alumnes-monlau.com/storage/photos/por_defecto/user_default.png';
    
            // Obtener contenido de la imagen
            $imageContent = file_get_contents($imageUrl);
    
            // Convertir a base64
            $imageBase64 = 'data:image/png;base64,' . base64_encode($imageContent);
    
        } catch (\Exception $e) {
            // Si falla, usar imagen por defecto
            $imageBase64 = 'data:image/png;base64,' . base64_encode(
                file_get_contents(public_path('storage/photos/por_defecto/user_default.png'))
            );
        }
    
        $pdf = PDF::loadView('students.showPDF', compact('student', 'imageBase64'))
                  ->setPaper('a4', 'portrait');
    
        return $pdf->stream('curriculum-' . $student->idStudent . '.pdf');
    }

    public function descargarPDF($idStudent)
    {
        $student = Student::with(['team', 'specialization', 'project'])->findOrFail($idStudent);

        // Intenta cargar la imagen
        try {
            $imageUrl = $student->photoName ?? 'https://jornadaautomocion.alumnes-monlau.com/storage/photos/por_defecto/user_default.png';

            // Obtener contenido de la imagen
            $imageContent = file_get_contents($imageUrl);

            // Convertir a base64
            $imageBase64 = 'data:image/png;base64,' . base64_encode($imageContent);

        } catch (\Exception $e) {
            // Si falla, usar imagen por defecto
            $imageBase64 = 'data:image/png;base64,' . base64_encode(
                file_get_contents(public_path('storage/photos/por_defecto/user_default.png'))
            );
        }

        $pdf = PDF::loadView('students.showPDF', compact('student', 'imageBase64'))
                ->setPaper('a4', 'portrait');

        return $pdf->stream('curriculum-' . $student->idStudent . '.pdf');
    }
    public function descargarProyectoPDF($idProject)
{
    // 1. Buscamos el proyecto específico.
    $project = Project::with(['students', 'specialization'])->findOrFail($idProject);
    $students = $project->students; 

    $projectImageBase64 = null;
    $initialStateImageBase64 = null; 

    // 2. Procesamos la imagen
    if ($project->photoName) {
        $path = storage_path('app/public/photos/' . $project->photoName);

        if (file_exists($path)) {
            $imageData = file_get_contents($path);
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            
            $base64 = 'data:image/' . $extension . ';base64,' . base64_encode($imageData);
            
            // Asignamos el valor a ambas variables para que la vista las encuentre
            $projectImageBase64 = $base64;
            $initialStateImageBase64 = $base64;
        }
    }

    // 3. Añadir 'initialStateImageBase64' al compact
    $pdf = Pdf::loadView('students.projectPDF', compact(
        'students', 
        'project', 
        'projectImageBase64',
        'initialStateImageBase64'
    ))->setPaper('a4', 'portrait');

    return $pdf->stream('Ficha_' . $project->idProject . '.pdf');
}
}
