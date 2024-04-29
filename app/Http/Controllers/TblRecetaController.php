<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\tbl_receta;
use App\Models\tbl_cliente;
use App\Models\tbl_receta_usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\tbl_usuarios;




class TblRecetaController extends Controller
{
    // constructor para los middleware
    public function __construct()
    {
        $this->middleware('auth', ['except'=>'index']);
        $this->middleware('AdminRol', ['only'=>['edit','update','active','inactive']]);
    }

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
        // paginate para mostrar X elementos por pagina
        $recetas = tbl_receta::paginate(4);
        return view('usuarios.CrudReceta',compact('recetas'));
    }

     // Carga la vista de Recetas Inactivas
     public function indexInactivas(){
        // paginate para mostrar X elementos por pagina
        $recetas = tbl_receta::where('etapa', false)
        ->paginate(4);
        return view('usuarios.CrudRecetaInactivas',compact('recetas'));
    }
    public function indexEspera(){
        // paginate para mostrar X elementos por pagina
        $recetas = tbl_receta::where('Estado', '2')
        ->paginate(4);
        return view('usuarios.CrudRecetasEnEspera',compact('recetas'));
    }

    public function indexSugeridas()
{
    $recetasLog = auth()->user()->recetasLog;
    $recetasIds = $recetasLog->pluck('receta_id');
    $recetas = tbl_receta::whereIn('Id_Receta', $recetasIds)
        ->with('detallesReceta.producto', 'detallesReceta.unidadMedida')
        ->get();

    return view('usuarios.recetasSugeridas', compact('recetas'));
}
    // Carga el formulario de Recetas
    public function create(){
        return view('usuarios.FormReceta');
    }

    
    public function store(Request $request)
    {
        // Validaciones
        $request->validate([
        'Nombre' => 'required',
        'Descripcion' => 'required',
        'Costo_Total' => 'required|integer',
        'Contribucion' => 'required|integer',
        'Estado' => 'required',
        'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ], [
        'Nombre.required' => 'El campo Nombre es obligatorio.',
        'Descripcion.required' => 'El campo Descripción es obligatorio.',
        'Costo_Total.required' => 'El campo Costo Total es obligatorio.',
        'Costo_Total.integer' => 'El campo Costo Total debe ser un número entero.',
        'Contribucion.required' => 'El campo Contribución es obligatorio.',
        'Contribucion.integer' => 'El campo Contribución debe ser un número entero.',
        'Estado.required' => 'El campo Estado es obligatorio.',
        'imagen.required' => 'El campo Imagen es obligatorio.',
        'imagen.image' => 'El archivo debe ser una imagen.',
        'imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o gif.',
        'imagen.max' => 'La imagen no debe ser mayor de 2MB.'
    ]);
    
        // Procesamiento de la imagen
        if ($request->hasFile('imagen')) {
            $imageName = time() . '.' . $request->imagen->extension();
            $request->imagen->move(public_path('imagenes/recetas/'), $imageName);
            $urlreceta = asset('imagenes/recetas/' . $imageName);
        } else {
            $urlreceta = "";
        }
    
        // Instanciación de la clase
        $receta = new tbl_receta;
       
        // Asignación de valores
        $receta->Nombre = $request->Nombre;
        $receta->Descripcion = $request->Descripcion;
        $receta->Costo_Total = $request->Costo_Total;
        $receta->Contribucion = $request->Contribucion;
        $receta->Estado = $request->Estado;
        $receta->imagen = $urlreceta;
        $receta->etapa = $request->etapa;
    
        // Guardado de datos
        $receta->save();

        // Registrar quién ingresó la receta
        $recetaLog = new tbl_receta_usuario();
        
        $recetaLog->receta_id = $receta->Id_Receta;
        $recetaLog->usuario_id = auth()->user()->Id_Empleado;
        $recetaLog->save();
    
        // Redireccionamiento y mensaje de éxito
        session()->flash('success', 'La receta fue registrada correctamente. Necesitamos que le des el detalle a la receta en este apartado, sino desea hacerlo dele click a "Volver"');
        return view('usuarios.frmDetalleReceta');
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

            $imagenUrl = $receta[0]->imagen;
            $urlComponentes = parse_url($imagenUrl);
            $imageName = $urlComponentes['path'];
            $urlproducto = public_path($imageName);

            if (file_exists($urlproducto)) {
            // Elimina la imagen del directorio
                unlink($urlproducto);
            }

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
    // // elimina registros de la base de datos
    public function destroy($Id_Receta){

        // codigo para eliminar los datos
        $receta = DB::table('tbl_receta')->where('Id_Receta', $Id_Receta)->get();
        if($receta){
            $imagenUrl = $receta[0]->imagen;
            $urlComponentes = parse_url($imagenUrl);
            $imageName = $urlComponentes['path'];
            DB::table('tbl_receta')->where('Id_Receta', $Id_Receta)->delete();

             // codigo para borrar la imagen del directorio
             $urlreceta = public_path($imageName);

             // Verifica si el archivo existe antes de intentar eliminarlo
             if (file_exists($urlreceta)) {
                 unlink($urlreceta);
             }

            return to_route('crudrecetas')->with('success','se elimino la receta de manera existosa');
        }else{
            return "no se lograron eliminar los datos";
        }
        
    }

    //función para inactivar la receta
    public function inactive($Id_Receta)
    {
            //Cambiar de estado al cliente (inactivo)
            $receta = tbl_receta::findOrFail($Id_Receta);
            $receta->etapa = false;
            $receta->save();

            return redirect()->route('crudrecetas')->with('success', 'Receta inactivada correctamente.');
    }
    //función para activar la receta
    public function active($Id_Receta)
    {
            //Cambiar de estado al cliente (inactivo)
            $receta = tbl_receta::findOrFail($Id_Receta);
            $receta->etapa = true;
            $receta->save();

            return redirect()->route('crudrecetas')->with('success', 'Receta activada correctamente.');
    }

    public function estandarizar($Id_Receta)
    {
        // bro como va?
        $recetaEspera = tbl_receta::findOrFail($Id_Receta);
        $recetaEspera->Estado = true;
        $recetaEspera->save();
        return redirect()->route('crudrecetas')->with('success', 'Receta Estandarizada correctamente.');
    }

    //muestra todas las recetas en el recetario
    public function recetario ()
    {
        $recetasActivas = tbl_receta::where('etapa', true)
        ->where('Estado','1')
        ->paginate(8);
        return view('usuarios.IndexReceta', compact('recetasActivas'));
    }
    
    public function showingrediente($Id_Receta)
    {
        //se llama el modelo de recetas y se interatua con las relaciones(funciones) que se hizo en los modelos de detallereceta y receta, y se utiliza el metodo "findOrFail" para encontrar la clave promaria del modelo y obtener una instancia de dicho modelo
        $receta = tbl_receta::with('detallesReceta.producto', 'detallesReceta.unidadMedida')->findOrFail($Id_Receta);
        return view('usuarios.Receta', compact('receta'));
    }

    public function pdf()
    {
        // obtiene todos los registros
        $recetas = tbl_receta::all();
        $imageName = [];
        // obtener el paht de la imagen
        for ($i = 0; $i < count($recetas); $i++) {
            $imagenUrl = $recetas[$i]->imagen;
            // Hacer algo con $imagenUrl
            $urlComponentes = parse_url($imagenUrl);
            $imageName[] = $urlComponentes['path'];
        }
        // elimina el servidor de la url
        // return dd($imageName);
        // mostrar pdf
        $pdf = Pdf::loadView('pdf.pdfrecetas',compact('recetas','imageName'));
        // descarga el pdf
        return $pdf->download('recetas.pdf');
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
        
        return view('usuarios.Receta', compact('receta', 'cantidadesAjustadas','cantidad'));
    }

    public function buscar(Request $request){
        // funcion para buscar registros
        $searchTerm = $request->input('buscar');
        $resultados = tbl_receta::where('Nombre', 'LIKE', '%' . $searchTerm . '%')->get();
        
        // return $resultados;
        return view('buscar.BuscarReceta', compact('resultados','searchTerm')); 
    }
    
}
