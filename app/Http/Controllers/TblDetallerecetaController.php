<?php

namespace App\Http\Controllers;

use App\Models\tbl_detallereceta;
use App\Models\tbl_producto;
use App\Models\tbl_receta;
use Illuminate\Http\Request;

class TblDetallerecetaController extends Controller
{
    // muestra el Index de Receta
    public function index()
    {
        return view('receta');
    }
    public function create()
    {
        return view('usuarios.frmDetalleReceta');
    }

    // Almacena datos del formulario
    public function store(Request $request)
    {
        // Validaciones
        $request->validate([
            'Id_Receta' => 'required|exists:tbl_receta,Id_Receta',
            'Cod_Producto' => 'required|exists:tbl_producto,Cod_Producto',
            'Cantidad' => 'required|numeric|min:0',
            'Cod_UMedida' => 'required|exists:tbl_umedida,Cod_UMedida',
        ]);

        // Crear nueva instancia de tbl_detallereceta y asignar valores
        $detalleReceta = new tbl_detallereceta;
        $detalleReceta->Id_Receta = $request->input('Id_Receta');
        $detalleReceta->Cod_Producto = $request->input('Cod_Producto');
        $detalleReceta->Cantidad = $request->input('Cantidad');
        $detalleReceta->Cod_UMedida = $request->input('Cod_UMedida');
        $detalleReceta->save();

        // Retornar a la vista de creación de detalleReceta
        return redirect()->route('detalleReceta.create')->with('success', 'El detalle de la receta fue guardado correctamente');
    }

    // Carga el formulario de edicion
    public function edit(tbl_detallereceta $detalleReceta)
    {
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
