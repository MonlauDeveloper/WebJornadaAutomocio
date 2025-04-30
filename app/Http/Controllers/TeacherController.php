<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Education;
use App\Models\Language;
use App\Models\WorkExperience;
use App\Models\Contact;
use App\Models\Project;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $specializations = \App\Models\Specialization::all(); // Obtener todas las especializaciones
        $cursos = ['A', 'B', 'C', 'D', 'E', 'F']; // Lista de cursos disponibles

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

        // Filtro para mostrar solo estudiantes pendientes de verificación (con exclamación roja)
        if ($request->has('verification_status') && $request->verification_status == 'pending') {
            $query->where(function ($q) {
                $q->whereNull('verification_status')
                    ->orWhere('verification_status', '!=', 'verificado');
            });
        }

        // Determinar el número de elementos por página según la vista seleccionada
        $perPage = $request->has('view') && $request->view === 'list' ? 35 : 6;

        // Cargar las relaciones necesarias para la verificación
        $students = $query->with(['languages', 'educations', 'workExperiences', 'contacts', 'project'])->paginate($perPage);

        // Evaluar el estado de verificación de cada estudiante
        foreach ($students as $student) {
            $project = $student->project;
            $student->verification_status = $this->getVerificationStatus($student, $project);
        }

        return view('teachers.myStudents', compact('students', 'specializations', 'cursos'));
    }


    private function getVerificationStatus(Student $student, $project)
    {
        if ($student->verification_status == 'verificado') {
            return 'check-circle text-green-500'; // Verificación completa (✔)
        } else {
            // Verificar los campos en la tabla 'students'
            if (is_null($student->name) || is_null($student->surname1) || is_null($student->surname2) || is_null($student->photoName) || is_null($student->introduction) || is_null($student->idSpecialization) || is_null($student->curso)) {
                return 'exclamation-circle text-red-500'; // Advertencia (¡)
            }

            // Verificar los campos del proyecto
            if (is_null($project->title) || is_null($project->idSpecialization) || is_null($project->curso) || is_null($project->photoName) || is_null($project->videoURL) || is_null($project->pdfURL) || is_null($project->moodleURL) || is_null($project->abstract) || is_null($project->idUbication)) {
                return 'exclamation-circle text-red-500'; // Advertencia (¡)
            }

            // Verificar la ubicación del proyecto
            if (is_null($project->ubication->ubicationName)) {
                return 'exclamation-circle text-red-500'; // Advertencia (¡)
            }

            // Verificar relaciones (si existen y no están vacías)
            if ($student->contacts->isEmpty() || $student->languages->isEmpty() || $student->educations->isEmpty() || $student->workExperiences->isEmpty()) {
                return 'exclamation-circle text-red-500'; // Advertencia (¡)
            }
        }
        // Si todo está completo, es un estado verificado
        return 'check-circle text-yellow-500'; // Verificación completa (✔)
    }


    public function verifyDetails($idStudent)
    {
        // Cargar el estudiante con todas sus relaciones, incluyendo el proyecto y la especialización
        $student = Student::with([
            'languages',
            'educations',
            'workExperiences',
            'contacts',
            'project',
            'specialization',  // Cargar especialización
            'project.ubication'  // Cargar la ubicación del proyecto
        ])->findOrFail($idStudent);

        // Obtener el proyecto
        $project = $student->project;

        // Verificación de los campos y relaciones
        $verificationStatus = $this->getVerificationStatus($student, $project);  // Método que definimos anteriormente

        return view('teachers.verifyStudent', compact('student', 'verificationStatus', 'project'));
    }

    public function verify($idStudent)
    {
        $student = Student::findOrFail($idStudent);

        if ($student->verification_status == 'verificado') {
            $student->verification_status = null; // O el estado que desees

        } else {
            $student->verification_status = 'verificado'; // O el estado que desees
        }

        $student->save();

        // Redirige al usuario después de la acción
        return redirect()->route('teachers.myStudents')->with('success', 'Estudiante verificado con éxito.');
    }


}
