<?php

namespace App\Http\Controllers;

use App\Models\tbl_receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TblRecetaController extends Controller
{
    public function Mostrarimagen(Request $request, $id ){
    $id=$request->Id_Receta;
    $imagen=tbl_receta::find($id);
    if($imagen)
    {
        $imagenmostrada=base64_encode($imagen->imagen);

        return view('index',['imagen'=>$imagenmostrada]);
    }else{
        return "NO FUNCA";
    }
    }

    // Carga la vista de Recetas
    public function index(){

        $recetas="";
        $recetas = tbl_receta::all();
        return view('usuarios.CrudReceta',compact('recetas'));
    }
    // Carga el formulario de Recetas
    public function create(){
        return view('usuarios.FormReceta');
    }
    // Almacena los datos del registro en la BD
    public function store(Request $request){

        // codigo de validacion formulario desde el backend
        $request->validate([
            'Id_Receta'=>'required',
            'Nombre'=>'required',
            'Descripcion'=>'required',
            'Costo_Total'=>'required',
            'Contribucion'=>'required',
            'Estado'=>'required',
            'imagen'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048'

        ]);

        if($request->hasFile('imagen')){
            $imageName = time().'.'.$request->imagen->extension();
            $request->imagen->move(public_path('imagenes/recetas/'), $imageName);
            $urlreceta = asset('imagenes/recetas/'. $imageName);
        }else{
            $urlreceta = "";
        }

        // se instancia la clase
        $receta= new tbl_receta;
        $receta->Id_Receta = $request->Id_Receta;
        $receta->Nombre = $request->Nombre;
        $receta->Descripcion = $request->Descripcion;
        $receta->Costo_Total = $request->Costo_Total;
        $receta->Contribucion = $request->Contribucion;
        $receta->Estado = $request->Estado;
        $receta->imagen = $urlreceta;

        // guardar datos
        $receta->save();
        //parte Edilberto
        session()->flash('confirm-receta','La receta fue registrada correctamente');
        // retorna a la vista de las recetas
        return to_route('receta.create');

    }

    // Carga el formulario de editar receta
    public function edit($Id_Receta){
        $receta = DB::table('tbl_receta')->where('Id_Receta', $Id_Receta)->get();
        return view('usuarios.EditReceta', compact('receta'));
    }
    // Actualiza los datos del registro en la abla en la BD
    public function update(Request $request, $Id_Receta){

       // devuelve un array del objeto
       $receta = DB::table('tbl_receta')->where('Id_Receta', $Id_Receta)->get();
       $request->validate([
           'imagen1'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048'
       ]);
        // condicional de imagen
        if($request->hasFile('imagen1')){
           $imageName = time().'.'.$request->imagen1->extension();
           $request->imagen1->move(public_path('imagenes/recetas/'), $imageName);
           $urlreceta = asset('imagenes/recetas/'. $imageName);
       }else{
           $urlreceta = "";
       }
       // rempleza la imagen de la bd
       $request['imagen'] = $urlreceta;
       // dd($request);

       // actualiza los datos
       if($receta){
           DB::table('tbl_receta')->where('Id_Receta', $Id_Receta)->update($request->except(['_token','_method','imagen1']));
           return to_route('crudrecetas');
       }else{
           return "no se pudo actulizar";
       }
    }
    // elimina registros de la base de datos
    public function destroy($Id_Receta){

        // codigo para eliminar los datos
        $receta = DB::table('tbl_receta')->where('Id_Receta', $Id_Receta)->get();
        if($receta){
            DB::table('tbl_receta')->where('Id_Receta', $Id_Receta)->delete();
            return to_route('crudrecetas')->with('success','se elimino la receta de manera existosa');
        }else{
            return "no se lograron eliminar los datos";
        }
    }

    //muestra todas las recetas en el recetario
    public function recetario ()
    {
        $recetas = tbl_receta::all();

        return view('usuarios.IndexReceta', compact('recetas'));
    }

    
    
    public function showingrediente($Id_Receta)
    {
        //se llama el modelo de recetas y se interatua con las relaciones(funciones) que se hizo en los modelos de detallereceta y receta, y se utiliza el metodo "findOrFail" para encontrar la clave promaria del modelo y obtener una instancia de dicho modelo
        $receta = tbl_receta::with('detallesReceta.producto', 'detallesReceta.unidadMedida')->findOrFail($Id_Receta);
        

        return view('usuarios.Receta', compact('receta'));
    }

    public function cantidadmultiplicada(Request $request, $Id_Receta)
    {
        $receta = tbl_receta::with('detallesReceta.producto', 'detallesReceta.unidadMedida')->findOrFail($Id_Receta);

        //se crea una variable para obtener el numero de porciones ingresado en el input
        $porciones = $request->input('porciones');

        //se crea una variable como arreglo la cual va a contener el producto, la multiplicacion de los productos y la unida de medida
        $cantidadesAjustadas = [];
        
        //se crea el foreach para recorrer el id de la receta en la tabla de detallereceta
        foreach ($receta->detallesReceta as $detalle) {
            $cantidadAjustada = $detalle->Cantidad * $porciones;
            $cantidadesAjustadas[] = [
                'producto' => $detalle->producto,
                'cantidadAjustada' => $cantidadAjustada,
                'unidadMedida' => $detalle->unidadMedida
            ];
        }

        return view('usuarios.Receta', compact('receta', 'cantidadesAjustadas','porciones'));
    }
    
}
