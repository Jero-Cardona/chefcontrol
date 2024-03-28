<?php

namespace App\Http\Controllers;

use App\Models\tbl_tareas;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\tbl_tareascompletadas;
use Illuminate\Http\Request;

class TblTareascompletadasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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

    }


    public function create ()
    {
        //
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tbl_tareascompletadas  $tbl_tareascompletadas
     * @return \Illuminate\Http\Response
     */
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
