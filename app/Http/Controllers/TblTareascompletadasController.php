<?php

namespace App\Http\Controllers;

use App\Models\tbl_tareas;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\tbl_tareascompletadas;
use App\Models\tbl_usuarios;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TblTareascompletadasController extends Controller
{
    // funcion de autentificacion de usuario
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexInicio()
    {
        
        // Obtener los registros de tareas completadas agrupados por fecha y filtrados por id_tarea <= 23
        $tareasCompletadasPorFecha = tbl_tareascompletadas::with('usuario', 'tarea')
        ->whereHas('tarea', function ($query) {
            $query->where('id_tarea', '<=', 22);
        })
        ->orderBy('fecha')
        ->get()
        ->groupBy('fecha');

        return view('usuarios.CrudListaInicio', compact('tareasCompletadasPorFecha'));
    }
    
    public function indexFin()
    {
        // Obtener los registros de tareas completadas agrupados por fecha y filtrados por id_tarea <= 23
        $tareasCompletadasPorFecha = tbl_tareascompletadas::with('usuario', 'tarea')
        ->whereHas('tarea', function ($query) {
            $query->where('id_tarea', '>=', 23);
        })
        ->orderBy('fecha')
        ->get()
        ->groupBy('fecha');

        return view('usuarios.CrudListaFin', compact('tareasCompletadasPorFecha'));
        }

   
    public function store(Request $request)
    {
       
        // Validar los datos recibidos del formulario
        $request->validate([
            'Id_Empleado' => 'required',
            'id_tarea' => 'required|array', // Se espera un arreglo de tareas
            'fecha' => ['required', 'date_format:Y-m-d H:i:s'],
            
        ]);
    
        $fecha = $request->input('fecha');
        $fechaActual = Carbon::createFromFormat('Y-m-d H:i:s', $fecha);

            $tareasSeleccionadas = $request->input('id_tarea', []);
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
    
                return redirect()->route('usuarios.index')->with('status', 'Lista Incio de Jornada guardada correctamente.');
            } else {
                return redirect()->route('lista.inicio')->with('status', 'No fue posible guardar la Lista de Inicio de Jornada.');
        }
    }
    
}
