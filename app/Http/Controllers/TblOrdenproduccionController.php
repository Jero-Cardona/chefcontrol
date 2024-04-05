<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\tbl_ordenproduccion;
use App\Models\tbl_receta;
use Illuminate\Http\Request;

class TblOrdenproduccionController extends Controller
{
    public function create(){
        // vista del formulario de orden de produccion 
        return view('usuarios.Formorden');
    }

    public function store(Request $request)
    {
        date_default_timezone_set('America/Bogota');
        // codigo de validacion formulario desde el backend
        $request->validate([
            'Fecha'=>['required','date_format:Y-m-d H:i:s'],
            'Id_Cliente'=>'required',
            'Id_Empleado'=>'required',
            'Id_Receta'=>'required',
            'cantidad'=>'required',
            'estado'=>'required'
        ]);

        $fecha = $request->input('Fecha');

        // Crear una instancia de Carbon para obtener la fecha y hora actual
        $fechaActual = Carbon::createFromFormat('Y-m-d H:i:s', $fecha);

        // se instancia la clase
        $produccion= new tbl_ordenproduccion;
        $produccion->Fecha = $fechaActual;
        $produccion->Id_Cliente = $request->Id_Cliente;
        $produccion->Id_Empleado = $request->Id_Empleado;
        $produccion->Id_Receta = $request->Id_Receta;
        $produccion->cantidad = $request->cantidad;
        $produccion->estado = $request->estado;
 
        // $produccion->imagen = $urlreceta;
        $produccion->save();

        //mensaje de envio de datos
        session()->flash('confirm-produccion$produccion','La produccion$produccion fue registrada correctamente');
        // retorna a la vista de las recetas
        return to_route('receta.recetario');
    }

    public function cantidadmultiplicada(Request $request, $Id_Receta)
    {
        $receta = tbl_receta::with('detallesReceta.producto', 'detallesReceta.unidadMedida')->findOrFail($Id_Receta);
        //se crea una variable para obtener el numero de porciones ingresado en el input
        $cantidad = $request->cantidad;
        //se crea una variable como arreglo la cual va a contener el producto, la multiplicacion de los productos y la unida de medida
        $cantidadesAjustadas = [];
        
        //se crea el foreach para recorrer el id de la receta en la tabla de detallereceta
        foreach ($receta->detallesReceta as $detalle) {
            $cantidadAjustada = $detalle->Cantidad * $cantidad;
            $cantidadesAjustadas[] = [
                'producto' => $detalle->producto,
                'cantidadAjustada' => $cantidadAjustada,
                'unidadMedida' => $detalle->unidadMedida
            ];
        }

        // $cliente = tbl_cliente::findOrFail($request->Id_Cliente);

        // Procesar el formulario y guardar el valor de cantidad en la sesión
        session()->flash('cantidad', $request->cantidad);
        
        
        return view('usuarios.Receta', compact('receta', 'cantidadesAjustadas','cantidad'));
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


