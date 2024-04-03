<?php

namespace App\Http\Controllers;

use App\Models\tbl_cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TblClienteController extends Controller
{
    
    public function index()
    {
        $clientes = tbl_cliente::all();
        return view('usuarios.CrudCliente',compact('clientes'));
    }

    public function create()
    {
        return view('usuarios.FormCliente');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Id_Cliente'=>'required',
            'Tipo_identificacion'=>'required',
            'Nombre'=>'required',
            'Apellido'=>'required',
            'Telefono'=>'required',
            'estado'=>'required'
        ]);

        $cliente = new tbl_cliente();
        $cliente->Id_Cliente = $request->input('Id_Cliente');
        $cliente->Tipo_identificacion = $request->input('Tipo_identificacion');
        $cliente->Nombre = $request->input('Nombre');
        $cliente->Apellido = $request->input('Apellido');
        $cliente->Telefono = $request->input('Telefono');
        $cliente->estado = $request->input('estado');
        $cliente->save();
        // retorna a la vista del index
        session()->flash('confirm-cliente','Cliente registrado correctamente');
        return to_route('usuarios.index');

    }
    // formulario para editar clientes
    public function edit($Id_Cliente){

        $cliente = DB::table('tbl_cliente')->where('Id_Cliente', $Id_Cliente)->get();
        return view('usuarios.EditCliente', compact('cliente'));
    }


    public function update(Request $request, $Id_Cliente)
    {
        // funcion para actualizar los datos
        $cliente = DB::table('tbl_cliente')->where('Id_Cliente', $Id_Cliente)->get();
        if($cliente){
            DB::table('tbl_cliente')->where('Id_Cliente', $Id_Cliente)->update($request->except(['_token','_method']));
            return to_route('crudclientes');
    }else{
        return "no se pudo actulizar";
    };
    }

    public function destroy($Id_Cliente)
    {
         // codigo para eliminar los datos
         $cliente = DB::table('tbl_cliente')->where('Id_Cliente', $Id_Cliente)->get();
         if($cliente){
             DB::table('tbl_cliente')->where('Id_Cliente', $Id_Cliente)->delete();
             return to_route('crudclientes')->with('success','se elimino el cliente de manera existosa');
         }else{
             return "no se lograron eliminar los datos";
         }
    }

    public function getClientes()
{
    return tbl_cliente::all();
}
}
