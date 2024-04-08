<?php

namespace App\Http\Controllers;

use App\Models\tbl_tareas;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\tbl_tareascompletadas;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TblTareascompletadasController extends Controller
{
    // funcion de autentificacion de usuario
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //Edilberto
        $tareasCompletadas = tbl_tareas::all();
        return view('usuarios.LIstaInicio', ['tareasCompletadas' => $tareasCompletadas]);
    }

   
    public function storeInicio(Request $request)
    {
        // obtiene una fecha predeterminada
        date_default_timezone_set('America/Bogota');

        $request->validate([
            'Id_Empleado'=>'required',
            'items'=>'required',
            'fecha'=>['required','date_format:Y-m-d H:i:s'],

        ]);
        $fecha = $request->input('fecha');
        $fechaActual = Carbon::createFromFormat('Y-m-d H:i:s', $fecha);

        // try{
            $tareasSeleccionadas = $request->input('items', []);
            if (is_array($tareasSeleccionadas))
            {
                $Id_Empleado = Auth::user()->Id_Empleado;
                foreach ($tareasSeleccionadas as $tareaId) {
                    $tareaCompletada = new tbl_tareascompletadas([
                        'Id_Empleado' => $Id_Empleado,
                        'id_tarea' => $tareaId,
                        'fecha' => $fechaActual
                    ]);
                    $tareaCompletada->save();
                }
    
                return redirect()->route('usuarios.index')->with('status', 'Tareas completadas guardadas exitosamente.');
            } else {
                return redirect()->route('lista.inicio')->with('status', 'no se estan seguistrando las tareas');
        }
        // }catch (Exception $mensaje){
        //     $mensaje->getMessage();
        // }
    
    }

    public function storeFin(Request $request)
    {
        // obtiene una fecha predeterminada
        date_default_timezone_set('America/Bogota');

        $request->validate([
            'Id_Empleado'=>'required',
            'id_tarea'=>'required',
            'fecha'=>['required','date_format:Y-m-d H:i:s'],

        ]);
        $fecha = $request->input('fecha');
        $fechaActual = Carbon::createFromFormat('Y-m-d H:i:s', $fecha);

        // try{
            $tareasSeleccionadas = $request->input('items', []);
            if (is_array($tareasSeleccionadas))
            {
                $Id_Empleado = Auth::user()->Id_Empleado;
                foreach ($tareasSeleccionadas as $tareaId) {
                    $tareaCompletada = new tbl_tareascompletadas([
                        'Id_Empleado' => $Id_Empleado,
                        'id_tarea' => $tareaId,
                        'fecha' => $fechaActual
                    ]);
                    $tareaCompletada->save();
                }
    
                return redirect()->route('usuarios.index')->with('status', 'Tareas completadas guardadas exitosamente.');
            } else {
                return redirect()->route('usuarios.index')->with('status', 'no se estan seguistrando las tareas');
        }
        // }catch (Exception $mensaje){
        //     $mensaje->getMessage();
        // }
    
    }


}
