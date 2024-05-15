<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use App\Models\tbl_usuarios;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Barryvdh\DomPDF\Facade\Pdf;

class TblUsuariosController extends Controller
{
    // constructor para los middleware
    public function __construct()
    {
        $this->middleware('AdminRol', ['only' => ['edit', 'update', 'active', 'inactive']]);
    }

    // sobreescribe el metodo
    public function username()
    {
        return 'Id_Empleado';
    }

    // Consulta los usuarios y retorna la vista con todos
    public function index()
    {
        $usuarios = tbl_usuarios::paginate(4);
        return view('index', compact('usuarios'));
    }


    //Carga el formulario para el registro de Usuarios
    public function create()
    {
        return view('usuarios.registro');
    }

    //Carga el formulario para el registro de Usuarios Admin
    public function createAdmin()
    {
        return view('usuarios.registroAdmin');
    }

    // Guarda a los usuarios en la base de datoswq
    public function store(Request $request)
    {
        $request->validate([
            'Id_Empleado' => 'required',
            'tipo_documento' => 'required',
            'Nombre' => 'required',
            'Apellido' => 'required',
            'Telefono' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'Id_Rol' => 'required',
            'estado' => 'required'
        ], [
            'Id_Empleado.required' => 'El campo Numero de documento es obligatorio.',
            'tipo_documento.required' => 'El campo Tipo de Documento es obligatorio.',
            'Nombre.required' => 'El campo Nombre es obligatorio.',
            'Apellido.required' => 'El campo Apellido es obligatorio.',
            'Telefono.required' => 'El campo Teléfono es obligatorio.',
            'password.required' => 'El campo Contraseña es obligatorio.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
            'Id_Rol.required' => 'El campo Rol es obligatorio.'
        ]);

        // Crear una nueva instancia de usuario
        $usuario = new User;

        // Asignar los valores
        $usuario->Id_Empleado = $request->input('Id_Empleado');
        $usuario->tipo_documento = $request->input('tipo_documento');
        $usuario->Nombre = $request->input('Nombre');
        $usuario->Apellido = $request->input('Apellido');
        $usuario->Telefono = $request->input('Telefono');
        $usuario->password = bcrypt($request->input('password'));
        $usuario->Id_Rol = $request->input('Id_Rol');
        $usuario->estado = $request->input('estado');
        $usuario->save();

        // Redirigir a la ruta de inicio de sesión con un mensaje de éxito
        return redirect()->route('login')->with('status', 'Usuario Registrado Exitosamente');
    }

    public function login()
    {
        // $usuario = DB::table('tbl_usuarios')->where('Id_Empleado', $Id_Empleado)->get();
        // return view ('usuarios.login', compact('usuario'));
        return view('usuarios.login');
    }

    // Validar Datos e Iniciar Sesion
    public function storeLogin(Request $request)
    {
        $credentials = $request->validate([
            'Id_Empleado' => ['required', 'int'],
            'tipo_documento' => 'required',
            'password' => ['required', 'string']
        ]);

        // Validación de credenciales
        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            // Indicar error de validación genérico
            throw ValidationException::withMessages([
                'credentials' => __('auth.failed')
            ]);
        }

        // Identificador de sesión
        $request->session()->regenerate();

        return redirect()->intended('Recetario')
            ->with('inicio', '!Bienvenido de nuevo¡');
    }

    // funcion para salir de la sesion
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login')
            ->with('logout', 'Has cerrado sesión correctamente.');
    }

    // Carga el formulario de edicion de los datos
    public function edit($Id_Empleado)
    {
        //funcion para traer el id 
        $usuario = DB::table('tbl_usuarios')->where('Id_Empleado', $Id_Empleado)->get();
        return view('usuarios.EditUsuario', compact('usuario'));
    }

    // Actualiza los datos de los usuarios en la base de datos
    public function update(Request $request, $Id_Empleado)
    { 
        try{
       
            $usuario = DB::table('tbl_usuarios')->where('Id_Empleado', $Id_Empleado)->get();
            if ($usuario) {
                DB::table('tbl_usuarios')->where('Id_Empleado', $Id_Empleado)->update($request->except(['_token', '_method']));
                return to_route('usuarios.index');
            } else {
                return "no se pudo actulizar";
            };
        
        }catch(\Exception $e){ 
        return response()->json([
                    'error' => 'Error al actualizar el establecimiento: ' . $e->getMessage(),
                  ], 500);
        }   
    }

    // Elimina los registros de la base de datos
    public function destroy($Id_Empleado)
    {
        $usuario = DB::table('tbl_usuarios')->where('Id_Empleado', $Id_Empleado)->get();
        if ($usuario) {
            DB::table('tbl_usuarios')->where('Id_Empleado', $Id_Empleado)->delete();
            return to_route('usuarios.index');
        } else {
            return "no se lograron eliminar los datos";
        }
    }

    //función para inactivar el cliente
    public function inactive($Id_Empleado)
    {
        //Cambiar de estado al cliente (inactivo)
        $usuario = tbl_usuarios::findOrFail($Id_Empleado);
        $usuario->estado = false;
        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Cliente inactivado correctamente.');
    }

    //función para activar el usuario
    public function active($Id_Empleado)
    {
        //Cambiar de estado al usuario (activo)
        $usuario = tbl_usuarios::findOrFail($Id_Empleado);
        $usuario->estado = true;
        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Cliente activado correctamente.');
    }

    public function pdf()
    {
        $usuarios = tbl_usuarios::all();
        // mostrar pdf
        
        $pdf = Pdf::loadView('pdf.pdfusuarios', compact('usuarios'));
        // descarga el pdf
        return $pdf->download('usuarios.pdf');
    }
    public function pdfunico($Id_Empleado)
    {
        $usuario = tbl_usuarios::where('Id_Empleado', $Id_Empleado)->firstOrFail();
        // mostrar pdf
        $pdf = Pdf::loadView('pdf.pdfusuario', compact('usuario'));
        // descarga el pdf
        return $pdf->download('usuario.pdf');
    }

    public function buscar(Request $request)
    {
        // funcion para buscar registros
        $searchTerm = $request->input('buscar');
        $resultados = tbl_usuarios::where('Nombre', 'LIKE', '%' . $searchTerm . '%')->get();

        if ($resultados->isEmpty()) {
            return redirect()->route('usuarios.index')
                ->with('mensaje', '¡Usuario ' . $searchTerm . ' no encontrado!');
        } else {
            return view('buscar.BuscarUsuario', compact('resultados', 'searchTerm'));
        }
    }

    // public function mostrar(\exception $e){
    //     return response()->json([
    //         'error' => 'Error al actualizar el establecimiento: ' . $e->getMessage(),
    //       ], 500);
    // }


}
