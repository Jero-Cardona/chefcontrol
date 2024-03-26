<?php

namespace App\Http\Controllers;

use App\Models\tbl_tareas;
use App\Models\tbl_tareascompletadas;
use Illuminate\Http\Request;

class TblTareascompletadasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Edilberto
        $tareasCompletadas = tbl_tareas::all();
        return view('usuarios.LIstaInicio', ['tareasCompletadas' => $tareasCompletadas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fecha = date('Y-m-d H:i:s');
        $Id_Empleado = $request->input('Id_Empleado'); // Obtener el ID del empleado desde la solicitud
        foreach($request->items as $item){
            TblTareascompletadasController::create([
                'Id_Empleado' => $Id_Empleado,
                'id_tarea' => $item,
                'fecha' =>  $fecha // Obtener la fecha actual
            ]);
        }
        //Edilberto
        return view('usuario.LIstaInicio', ['Id_Empleado' => $Id_Empleado]);
       
        $tareasCompletadas = $request->input('tareas'); // Obtener los IDs de las tareas completadas desde la solicitud

        // Recorrer los IDs de las tareas completadas y crear registros en la tabla tbl_tareascompletadas
        foreach ($tareasCompletadas as $id) {
            
        }

        // Redirigir a alguna parte después de guardar las tareas completadas
        return redirect()->route('lista.store');
    }

    public function create (){
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
