<?php

namespace App\Http\Controllers;

use App\Models\tbl_tareas;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\tbl_tareascompletadas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Exception; 

class TblTareascompletadasController extends Controller
{
<<<<<<< HEAD
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
=======
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
>>>>>>> jero

   
    public function storeInicio(Request $request)
    {
<<<<<<< HEAD

        try{



        $tareasSeleccionadas = $request->input('items', []);

        if (is_array($tareasSeleccionadas)) {
            $userId = Auth::id();

            foreach ($tareasSeleccionadas as $tareaId) {
                $tareaCompletada = new tbl_tareascompletadas([
                    'Id_Empleado' => $userId,
                    'id_tarea' => $tareaId,
                    'fecha' => now()
                ]);
                $tareaCompletada->save();
            }

            return redirect()->route('lista.inicio')->with('success', 'Tareas completadas guardadas exitosamente.');
        } else {
            return redirect()->route('lista.store')->with('error', 'No se seleccionaron tareas.');
    }
    }
    catch (Exception $e){
        $e->getMessage('no se guardo');
    }
}

    public function index()
    {

        $estado = tbl_tareas::where('id_formato','=','1')->get();

            return view('usuarios.ListaInicio', compact('estado'));

=======
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
>>>>>>> jero
    }


    public function create ()
    {
        //
    }

<<<<<<< HEAD


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tbl_tareascompletadas  $tbl_tareascompletadas
     * @return \Illuminate\Http\Response
     */
=======
>>>>>>> jero
    public function show(tbl_tareascompletadas $tbl_tareascompletadas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tbl_tareascompletadas  $tbl_tareascompletadas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tbl_tareascompletadas $tbl_tareascompletadas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tbl_tareascompletadas  $tbl_tareascompletadas
     * @return \Illuminate\Http\Response
     */
    public function destroy(tbl_tareascompletadas $tbl_tareascompletadas)
    {
        //
    }

}
