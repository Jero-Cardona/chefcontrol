<?php

namespace App\Http\Controllers;

use App\Models\tbl_tareas;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\tbl_tareascompletadas;
use Illuminate\Http\Request;

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

   
    public function store(Request $request)
    {
        try{
            $tareasSeleccionadas = $request->input('items', []);
            if (is_array($tareasSeleccionadas))
            {
                $Id_Empleado = Auth::user()->Id_Empleado;
                foreach ($tareasSeleccionadas as $tareaId) {
                    $tareaCompletada = new tbl_tareascompletadas([
                        'Id_Empleado' => $Id_Empleado,
                        'id_tarea' => $tareaId,
                        'fecha' => now()
                    ]);
                    $tareaCompletada->save();
                }
    
                return redirect()->route('usuarios.index')->with('status', 'Tareas completadas guardadas exitosamente.');
            } else {
                return redirect()->route('lista.inicio')->with('status', 'no se estan seguistrando las tareas');
        }
        }catch (Exception $mensaje){
            $mensaje->getMessage();
        }
    
        // $fecha = date('Y-m-d H:i:s');
        // $Id_Empleado = $request->input('Id_Empleado'); // Obtener el ID del empleado desde la solicitud
        // foreach($request->items as $item){
        //     TblTareascompletadasController::create([
        //         'Id_Empleado' => $Id_Empleado,
        //         'id_tarea' => $item,
        //         'fecha' =>  $fecha // Obtener la fecha actual
        //     ]);
        // }
        // //Edilberto
        // return view('usuario.LIstaInicio', ['Id_Empleado' => $Id_Empleado]);
       
        // $tareasCompletadas = $request->input('tareas'); // Obtener los IDs de las tareas completadas desde la solicitud

        // // Recorrer los IDs de las tareas completadas y crear registros en la tabla tbl_tareascompletadas
        // foreach ($tareasCompletadas as $id) {
            
        // }

        // // Redirigir a alguna parte después de guardar las tareas completadas
        // return redirect()->route('lista.store');
    }

}
