<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use App\Models\tbl_usuarios;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TblUsuariosController extends Controller
{
    // sobreescribe el metodo
    public function username()
    {
        return 'Id_Empleado';
    }

    // Consulta los usuarios y retorna la vista con todos
    public function index()
    {
        $usuarios = tbl_usuarios::all();
        return view('index',compact('usuarios'));
    }

    //Carga el formulario para el registro de Usuarios
    public function create(){
        return view('usuarios.registro');
    }
    
    // Guarda a los usuarios en la base de datoswq
    public function store(Request $request)
    {
        $request->validate([
            'Id_Empleado'=>'required',
            'tipo_documento'=>'required',
            'Nombre'=>'required',
            'Apellido'=>'required',
            'Telefono'=>'required',
            'password'=>['required', 'confirmed', Rules\Password::defaults()],
            'Id_Rol'=>'required'
        ]);

        // esto es una instancia
        $usuario = new User;
        // aqui se guardan los datos
        $usuario->Id_Empleado = $request->input('Id_Empleado');
        $usuario->tipo_documento = $request->input('tipo_documento');
        $usuario->Nombre = $request->input('Nombre');
        $usuario->Apellido = $request->input('Apellido');
        $usuario->Telefono = $request->input('Telefono');
        $usuario->password = bcrypt($request->input('password')); 
        $usuario->Id_Rol = $request->input('Id_Rol');
        $usuario->save();

        // autentificar el usuario

        return to_route('login')->with('status','Usuario Registrado Exitosamente');
        
    }
    

    public function login(){
        // $usuario = DB::table('tbl_usuarios')->where('Id_Empleado', $Id_Empleado)->get();
        // return view ('usuarios.login', compact('usuario'));
        return view('usuarios.login');

    }

    // Validar Datos e Iniciar Sesion
    public function storeLogin(Request $request)
    {
        $credentials = $request->validate([
            'Id_Empleado'=>['required','int'],
            'tipo_documento'=>'required',
            'password'=>['required', 'string']
        ]);
        
        // $usuario = DB::table('tbl_usuarios')->where('Id_Empleado', $Id_Empleado)->get();

            // validacion de Datos
            if ( ! Auth::attempt($credentials, $request->boolean('remember')))
            {
                // indica error de validacion
                throw ValidationException::withMessages([
                    'password'=>__('auth.failed')
                ]);
            }
        // Identificador de sesion
        $request->session()->regenerate();
            return redirect()->intended('recetas.index')->
            with('status', 'Has iniciado sesion Correctamente');
    }
    
    // funcion para salir de la sesion
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login')
        ->with('status','Has cerrado session correctamente');
    }


    // Carga el formulario de edicion de los datos
    public function edit($Id_Empleado)
    {
        //funcion para traer el id 
        $usuario = DB::table('tbl_usuarios')->where('Id_Empleado', $Id_Empleado)->get();
        return view ('usuarios.EditUsuario', compact('usuario'));
    }

    // Actualiza los datos de los usuarios en la base de datos
    public function update(Request $request,$Id_Empleado)
    { 
        $usuario = DB::table('tbl_usuarios')->where('Id_Empleado', $Id_Empleado)->get();
        if($usuario){
            DB::table('tbl_usuarios')->where('Id_Empleado', $Id_Empleado)->update($request->except(['_token','_method']));
            return to_route('usuarios.index');
    }else{
        return "no se pudo actulizar";
    };
    }

    // Elimina los registros de la base de datos
    public function destroy($Id_Empleado)
    {
        $usuario = DB::table('tbl_usuarios')->where('Id_Empleado', $Id_Empleado)->get();
        if($usuario){
            DB::table('tbl_usuarios')->where('Id_Empleado', $Id_Empleado)->delete();
            return to_route('usuarios.index');
        }else{
            return "no se lograron eliminar los datos";
        }
    }
}
