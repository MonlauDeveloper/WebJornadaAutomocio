<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
class AdminController extends Controller
{
    public function indexAceptadas()
    {
        $solicitudes = User::where('status', 'approved')
            ->whereHas('company') // Solo usuarios que tienen una empresa asociada
            ->with('company') // Eager load de la relación 'company'
            ->paginate(10); // Cambia a paginate(10) para paginar

        return view('admin.empresas_aceptadas', compact('solicitudes'));
    }

    public function index()
    {
        $solicitudes = User::where('status', 'pending')
            ->whereHas('company') // Solo usuarios que tienen una empresa asociada
            ->with('company') // Eager load de la relación 'company'
            ->paginate(10); // Cambia a paginate(10) para paginar

        return view('admin.solicitudes', compact('solicitudes'));
    }

    public function show($idUser)
    {
        // Buscar al usuario con su empresa relacionada
        $user = User::with('company')->findOrFail($idUser);

        return view('admin.show_solicitud', compact('user'));
    }

    public function showAceptada($idUser)
    {
        // Buscar al usuario con su empresa relacionada
        $user = User::with('company')->findOrFail($idUser);

        return view('admin.aprobadas_show', compact('user'));
    }

    public function approve($idUser)
    {
        $user = User::findOrFail($idUser);

        // Actualizar estado a aprobado
        $user->update(['status' => 'approved']);

        return redirect()->route('admin.solicitudes')->with('success', 'Solicitud aprobada correctamente.');
    }

    public function deny($idUser)
    {
        $user = User::findOrFail($idUser);

        // Alternativamente, podrías eliminar la relación:
        $user->company()->delete();

        // O simplemente marcar como denegado
        $user->update(['status' => 'denied']);

        return redirect()->route('admin.solicitudes')->with('success', 'Solicitud denegada.');
    }



    public function edit($idUser)
    {
        $user = User::with('company')->findOrFail($idUser);
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, $idUser)
    {
        $request->validate([
            'companyName' => 'required|string|max:255',
            'companyWeb' => 'nullable|url|max:255',
            'asistenteNombre' => 'required|string|max:255',
            'asistenteApellidos' => 'required|string|max:255',
            'telefonoAsistente' => 'required|string|max:15',
            'emailAsistente' => 'required|email|max:255',
            'cargoAsistente' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        $user = User::findOrFail($idUser);
        $company = $user->company;
    
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
    
            // Crear el ImageManager
            $imgManager = new ImageManager(new Driver());
    
            // Leer la imagen original
            $image = $imgManager->read($logo->getPathname());
    
            // Redimensionar al 80% de su tamaño original
            $image->scale(95);
    
            // Nombre del archivo convertido a WebP
            $logoName = time() . '_logo.webp';
    
            // Guardar la imagen en storage/app/public/logos_empresas
            $image->save(storage_path('app/public/photos/logos_empresas/' . $logoName), 95, 'webp');
    
            // Guardar la ruta en la base de datos
            $company->logo_url = 'logos_empresas/' . $logoName;
        }
    
        $user->update([
            'username' => $request->companyName,
            'email' => $request->emailAsistente,
        ]);

        $company->update([
            'companyName' => $request->companyName,
            'companyWeb' => $request->companyWeb,
            'asistenteNombre' => $request->asistenteNombre,
            'asistenteApellidos' => $request->asistenteApellidos,
            'telefonoAsistente' => $request->telefonoAsistente,
            'emailAsistente' => $request->emailAsistente,
            'cargoAsistente' => $request->cargoAsistente,
        ]);
    
        return redirect()->route('admin.empresas_aceptadas')->with('success', 'Empresa actualizada correctamente.');
    }







    public function myProfile()
    {
        $company = auth()->user()->company;  // Obtienes solo la empresa asociada
    
        if (!$company) {
            return redirect()->route('dashboard')->with('error', 'No se ha encontrado el perfil de empresa.');
        }
    
        // Ahora pasas solo la empresa a la vista, no el usuario completo
        return view('admin.myProfile', compact('company'));
    }
    

    public function updateProfile(Request $request)
    {
        // Obtener el usuario autenticado
        $user = auth()->user();
        $company = $user->company;
    
        // Verificar si la empresa existe
        if (!$company) {
            return redirect()->route('dashboard')->with('error', 'No se ha encontrado el perfil de empresa.');
        }
    
        // Validación de los datos
        $request->validate([
            'companyName' => 'required|string|max:255',
            'companyWeb' => 'nullable|url|max:255',
            'asistenteNombre' => 'required|string|max:255',
            'asistenteApellidos' => 'required|string|max:255',
            'telefonoAsistente' => 'required|string|max:15',
            'emailAsistente' => 'required|email|max:255|unique:users,email,' . $user->idUser . ',idUser',
            'cargoAsistente' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        // Manejo del logo si hay un nuevo archivo
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
    
            // Crear el ImageManager
            $imgManager = new ImageManager(new Driver());
    
            // Leer la imagen original
            $image = $imgManager->read($logo->getPathname());
    
            // Obtener dimensiones originales
            $width = $image->width();
            $height = $image->height();
    
            // Redimensionar al 80% de su tamaño original
            $image->resize($width * 0.95, $height * 0.95);
    
            // Nombre del archivo convertido a WebP
            $logoName = time() . '_logo.webp';
    
            // Guardar la imagen en storage/app/public/logos_empresas
            $image->save(storage_path('app/public/photos/logos_empresas/' . $logoName), 95, 'webp');
    
            // Guardar la ruta en la base de datos
            $company->logo_url = 'logos_empresas/' . $logoName;
        }
    
        // ⚠️ CORREGIDO: Ahora actualiza el usuario autenticado
        $user->update([
            'username' => $request->companyName,
            'email' => $request->emailAsistente,
        ]);
    
        // Actualizar la empresa con los datos proporcionados
        $company->update([
            'companyName' => $request->companyName,
            'companyWeb' => $request->companyWeb,
            'asistenteNombre' => $request->asistenteNombre,
            'asistenteApellidos' => $request->asistenteApellidos,
            'telefonoAsistente' => $request->telefonoAsistente,
            'emailAsistente' => $request->emailAsistente,
            'cargoAsistente' => $request->cargoAsistente,
        ]);
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('admin.myProfile')->with('success', 'Perfil actualizado correctamente.');
    }
    




    public function create()
    {
        return view('admin.create'); // Asegúrate de tener esta vista
    }

    // Almacena una nueva empresa en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'companyName' => 'required|string|max:255',
            'companyWeb' => 'nullable|url|max:255',
            'asistenteNombre' => 'required|string|max:255',
            'asistenteApellidos' => 'required|string|max:255',
            'telefonoAsistente' => 'required|string|max:15',
            'emailAsistente' => 'required|email|max:255',
            'cargoAsistente' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        // Crear el usuario asociado a la empresa
        $user = User::create([
            'username' => $request['companyName'],
            'email' => $request['emailAsistente'],
            'password' => Hash::make('Monlau2025'),
            'status' => 'approved',
            'idRole' => 5,
        ]);
    
        // Crear la nueva empresa y asignar el usuario
        $company = Company::create([
            'companyName' => $request['companyName'],
            'companyWeb' => $request['companyWeb'],
            'asistenteNombre' => $request['asistenteNombre'],
            'asistenteApellidos' => $request['asistenteApellidos'],
            'telefonoAsistente' => $request['telefonoAsistente'],
            'emailAsistente' => $request['emailAsistente'],
            'cargoAsistente' => $request['cargoAsistente'],
            'idUser' => $user->idUser,  // Asociamos el usuario a la empresa
        ]);
    
        // Manejo del logo (si hay archivo)
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
    
            // Crear el ImageManager
            $imgManager = new ImageManager(new Driver());
    
            // Leer la imagen original
            $image = $imgManager->read($logo->getPathname());
    
            // Redimensionar al 80% de su tamaño original
            $image->scale(95);
    
            // Nombre del archivo convertido a WebP
            $logoName = time() . '_logo.webp';
    
            // Guardar la imagen en storage/app/public/logos_empresas
            $image->save(storage_path('app/public/photos/logos_empresas/' . $logoName), 95, 'webp');
    
            // Asignar la ruta del logo en la empresa
            $company->logo_url = 'logos_empresas/' . $logoName;
    
            // Guardar los cambios de la empresa con el logo
            $company->save();
        }
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('admin.create')->with('success', 'Empresa creada correctamente.');
    }
    

}
