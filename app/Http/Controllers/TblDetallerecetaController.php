<?php

namespace App\Http\Controllers;

use App\Models\tbl_detallereceta;
use Illuminate\Http\Request;

class TblDetallerecetaController extends Controller
{
    // muestra el Index de Receta
    public function index()
    {
        return view('receta');
    }
    public function create(){
        return view('usuarios.FormReceta');
    }

    // Almacena datos del formulario
    public function store(Request $request)
    {
        $detalleReceta = new tbl_detallereceta;
        $detalleReceta->Id_Receta = $request->input('Id_Receta');
        $detalleReceta->Cod_Producto = $request->input('Cod_Producto');
        $detalleReceta->Cantidad = $request->input('Cantidad');
        $detalleReceta->Cod_UMedida = $request->input('Cod_UMedida');
        $detalleReceta->save();
        // Retorna a la vista de las recetas
        return to_route('detalleReceta.create');

        //parte Edilberto
        session()->flash('confirm-detalle-receta','El detalle de la receta fue guardado correctamente');
    }

    // Carga el formulario de edicion
    public function edit(tbl_detallereceta $detalleReceta){
        return view('receta.edit', compact('detalleReceta'));
    }

    // Actualizar datos del formulario
    public function update(Request $request, tbl_detallereceta $detalleReceta)
    {
        $detalleReceta->update($request->all());
        return to_route('recetas.index');
    }
    
    // se encarga de eliminar registros
    public function destroy(tbl_detallereceta $tbl_detallereceta)
    {
        //
    }
}
