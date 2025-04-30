<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Stmt\Return_;
use Tests\Feature\CreateApiTokenTest;

use function Laravel\Prompts\select;

class Apicontroller extends Controller
{
    public function login_API(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'password' => 'required',
        ]);
        
        $user = User::where('username', $request->user)->first();
        $user->tokens()->delete();
        if (!$user || !Hash::check($request->password, $user->password) || $user->idRole != 1) {
            throw ValidationException::withMessages([
                'user' => ['The provided credentials are incorrect.'],
            ]);
        }
        return $user->createToken($request->user)->plainTextToken;
    }

    //get the avalable pages of projects, companies,students, presentations and dynamic tests tables
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
    //get projects with pagination
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
        /*
            SELECT name, surname1,surname2,description,birthDate from speakers
            join rel_speakers_presentations on speakers.idSpeaker = rel_speakers_presentations.idSpeaker
            join presentations on presentations.idPresentation = rel_speakers_presentations.idPresentation
            join ubications on ubications.idUbication = presentations.idUbication
            WHERE presentations.idPresentation = 2;

        */
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

    //get project info and him students
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
}
