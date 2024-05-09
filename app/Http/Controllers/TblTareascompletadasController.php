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
                $query->where('id_formato', '=', 0);
            })
            ->orderBy('fecha')
            ->paginate(65);
        // ->get();
        // return $tareasCompletadasPorFecha;
        // ->groupBy('fecha');
        // ->paginate(6);
        $i = 1;
        return view('usuarios.CrudListaInicio', compact('tareasCompletadasPorFecha', 'i'));
    }

    public function vertareas($verlistas, $fecha)
    {
        if ($verlistas == 1) {
            $tareasCompletadasPorFecha = tbl_tareascompletadas::with('usuario', 'tarea')
                ->whereHas('tarea', function ($query) {
                    $query->where('id_tarea', '<=', 22);
                })
                ->where('fecha', $fecha)
                ->orderBy('fecha')
                ->get()
                ->groupBy('fecha');
            return view('usuarios.VerTareasInicio', compact('tareasCompletadasPorFecha', 'fecha'));
        } else {
            $tareasCompletadasPorFecha = tbl_tareascompletadas::with('usuario', 'tarea')
                ->whereHas('tarea', function ($query) {
                    $query->where('id_tarea', '>=', 23);
                })
                ->where('fecha', $fecha)
                ->orderBy('fecha')
                ->get()
                ->groupBy('fecha');
            return view('usuarios.VerTareasFin', compact('tareasCompletadasPorFecha', 'fecha'));
        }
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

        $i = 1;
        return view('usuarios.CrudListaFin', compact('tareasCompletadasPorFecha', 'i'));
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
        if (is_array($tareasSeleccionadas)) {
            $Id_Empleado = Auth::user()->Id_Empleado;
            foreach ($tareasSeleccionadas as $tareaId) {
                $tareaCompletada = new tbl_tareascompletadas([
                    'Id_Empleado' => $Id_Empleado,
                    'id_tarea' => $tareaId,
                    'fecha' => $fechaActual
                ]);
                $tareaCompletada->save();
            }
            return redirect()->route('receta.recetario')->with('status', 'Lista Incio de Jornada guardada correctamente.');
        } else {
            return redirect()->route('lista.inicio')->with('status', 'No fue posible guardar la Lista de Inicio de Jornada.');
        }
    }

    public function buscar(Request $request, $buscar)
    {

        $searchTerm = $request->input('buscar');
        if ($buscar == 1) {
            $resultados = tbl_tareascompletadas::with('usuario', 'tarea')
                ->where('fecha', 'LIKE', '%' . $searchTerm . '%')
                ->whereHas('tarea', function ($query) {
                    $query->where('id_tarea', '<=', 22);
                })
                ->orderBy('fecha')
                ->get()
                ->groupBy('fecha');
        } else {
            $resultados = tbl_tareascompletadas::with('usuario', 'tarea')
                ->where('fecha', 'LIKE', '%' . $searchTerm . '%')
                ->whereHas('tarea', function ($query) {
                    $query->where('id_tarea', '>=', 23);
                })
                ->orderBy('fecha')
                ->get()
                ->groupBy('fecha');
        }

        if ($resultados->isEmpty()) {
            if ($buscar == 1) {
                return redirect()->route('crud.listainicio')
                    ->with('mensaje', '¡No se encuentra listas registradas el dia: ' . $searchTerm . '!');
            } else {
                return redirect()->route('crud.listafin')
                    ->with('mensaje', '¡No se encuentra listas registradas el dia: ' . $searchTerm . '!');
            }
        } elseif ($buscar == 1) {
            return view('buscar.BuscarListaInicio', compact('resultados', 'searchTerm'));
        } else {
            return view('buscar.BuscarListaFin', compact('resultados', 'searchTerm'));
        }
    }
}
