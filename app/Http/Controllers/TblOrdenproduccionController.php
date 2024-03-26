<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\tbl_ordenproduccion;
use Illuminate\Http\Request;

class TblOrdenproduccionController extends Controller
{
    public function create(){
        // vista del formulario de orden de produccion 
        return view('usuarios.Formorden');
    }

    public function store(Request $request)
    {
        // codigo de validacion formulario desde el backend
        $request->validate([
            'Fecha'=>'required',
            'Id_Cliente'=>'required',
            'Id_Empleado'=>'required',
            'estado'=>'required'
        ]);

        // se instancia la clase
        $produccion= new tbl_ordenproduccion;
        $produccion->Fecha = $request->Id_Receta;
        $produccion->Id_Cliente = $request->Id_Cliente;
        $produccion->Id_Empleado = $request->Id_Empleado;
        $produccion->estado = $request->estado;
 
        // $produccion->imagen = $urlreceta;
        $produccion->save();

        //mensaje de envio de datos
        session()->flash('confirm-produccion$produccion','La produccion$produccion fue registrada correctamente');
        // retorna a la vista de las recetas
        return to_route('produccion$produccion.create');
    }

    // Carga el formulario de edicion de los datos
    public function edit($Consecutivo)
    {
        //funcion para traer el id 
        $usuario = DB::table('tbl_ordenproduccion')->where('Consecutivo', $Consecutivo)->get();
        return view ('usuarios.EditUsuario', compact('usuario'));
    }

    // Actualiza los datos de los usuarios en la base de datos
    public function update(Request $request,$Consecutivo)
    { 
        $usuario = DB::table('tbl_ordenproduccion')->where('Consecutivo', $Consecutivo)->get();
        if($usuario){
            DB::table('tbl_ordenproduccion')->where('Consecutivo', $Consecutivo)->update($request->except(['_token','_method']));
            return to_route('usuarios.index');
    }else{
        return "no se pudo actulizar";
    };
    }

    // Elimina los registros de la base de datos
    public function destroy(tbl_ordenproduccion $usuario)
    {
        $usuario->delete();
        return to_route('usuarios.index');
    }
}


