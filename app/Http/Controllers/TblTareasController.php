<?php

namespace App\Http\Controllers;

use App\Models\tbl_tareas;
use Illuminate\Http\Request;

class TblTareasController extends Controller
{
<<<<<<< HEAD
    public function index(){
            //Edilberto
            // $tareasCompletadas =tbl_tareas::all(); // Obtener todas las tareas registradas
            $estado = tbl_tareas::where('id_formato','=','1')->get();

            return view('usuarios.ListaInicio', compact('estado'));

        // $estado ->estado =  $request->estado;

        // if($estado==1){
        //     $estado = tbl_tareas::where('estado','=','1')->get();
        //     return $estado ;
        // }else{
        //     return "no funca";
        // }


    }

=======
    public function Inicio()
    {
        $estado = tbl_tareas::where('id_formato','=','0')->get();
        return view('usuarios.ListaInicio', compact('estado'));
    }
    
    public function Fin()
    {
        $estado = tbl_tareas::where('id_formato','=','1')->get();
        return view('usuarios.ListaFin', compact('estado'));
    }
>>>>>>> jero
}


