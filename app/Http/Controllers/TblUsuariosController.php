<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\tbl_usuarios;
use Illuminate\Http\Request;

class TblUsuariosController extends Controller
{
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
            'Id_Rol'=>'required'
        ]);

        // esto es una instancia
        $usuario = new tbl_usuarios;
        // aqui se guardan los datos
        $usuario->Id_Empleado = $request->input('Id_Empleado');
        $usuario->tipo_documento = $request->input('tipo_documento');
        $usuario->Nombre = $request->input('Nombre');
        $usuario->Apellido = $request->input('Apellido');
        $usuario->Telefono = $request->input('Telefono');
        $usuario->Id_Rol = $request->input('Id_Rol');
        $usuario->save();
        //parte Edilberto
        session()->flash('confirm-user','Usuario registrado correctamente');
        return to_route('usuarios.create');
        
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
