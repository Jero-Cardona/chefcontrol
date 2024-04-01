<?php

namespace App\Http\Controllers;

use App\Models\tbl_tareas;
use Illuminate\Http\Request;

class TblTareasController extends Controller
{
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
}


