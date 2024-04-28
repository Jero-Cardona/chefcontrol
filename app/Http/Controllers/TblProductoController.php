<?php

namespace App\Http\Controllers;

use App\Models\tbl_producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;



class TblProductoController extends Controller
{
    // constructor para los middleware
    public function __construct()
    {
        $this->middleware('auth', ['except'=>'index']);
        $this->middleware('AdminRol', ['only'=>['edit','update','active','inactive']]);
    }

    // Retorna el crud 
    public function index()
    {
        $productos = tbl_producto::paginate(4);
        return view('usuarios.CrudProducto',compact('productos'));
    }

    //Carga el formulario desde el directorio de Usuario
    public function create(){
        return view('usuarios.FormProducto');
    }

    public function store(Request $request)
{
    // Código de validación
    $request->validate([
        'Nombre' => 'required',
        'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'Stock_Minimo' => 'required|numeric', 
        'Stock_Maximo' => 'required|numeric', 
        'Fecha_Vencimiento' => 'nullable|date',
        'Costo' => 'required|numeric', 
        'Cod_Tipo' => 'required',
        'Ubicacion' => 'required',
        'Cod_UMedida' => 'required',
        'Precio_Venta' => 'required|numeric', 
        'Existencia' => 'required|numeric', 
        'IVA' => 'required|numeric' 
    ]);
    
    // Condición para manejar la imagen
    if ($request->hasFile('imagen')) {
        $imageName = time() . '.' . $request->imagen->extension();
        $request->imagen->move(public_path('imagenes/productos/'), $imageName);
        $urlproducto = asset('imagenes/productos/' . $imageName);
    } else {
        $urlproducto = "";
    }

    // Instancia de la clase Producto
    $producto = new tbl_producto;
    
    $producto->Nombre = $request->Nombre;
    $producto->imagen = $urlproducto;
    $producto->Stock_Minimo = $request->Stock_Minimo;
    $producto->Stock_Maximo = $request->Stock_Maximo;
    $producto->Fecha_Vencimiento = $request->Fecha_Vencimiento;
    $producto->Costo = $request->Costo;
    $producto->Cod_Tipo = $request->Cod_Tipo;
    $producto->Ubicacion = $request->Ubicacion;
    $producto->Cod_UMedida = $request->Cod_UMedida;
    $producto->Precio_Venta = $request->Precio_Venta;
    $producto->Existencia = $request->Existencia;
    $producto->IVA = $request->IVA;
    $producto->estado = $request->estado;


    if ($producto->save()) {
        session()->flash('confirm-producto', 'El producto ha sido registrado correctamente');
        return redirect()->route('usuarios.index');
    } else {
        return "datos no enviados";
    }
}




    // carga el formulario de receta
    public function edit($Cod_Producto)
    {
        $producto = DB::table('tbl_producto')->where('Cod_Producto', $Cod_Producto)->get();
        return view('usuarios.EditProducto', compact('producto'));
    }

    // Actuliza los Datos en la Base de Datos
    public function update(Request $request, $Cod_Producto)
    {
        // devuelve un array del objeto
        $producto = DB::table('tbl_producto')->where('Cod_Producto', $Cod_Producto)->get();
        $request->validate([
            'imagen1'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
         // condicional de imagen
         if($request->hasFile('imagen1')){

            $imagenUrl = $producto[0]->imagen;
            $urlComponentes = parse_url($imagenUrl);
            $imageName = $urlComponentes['path'];
            $urlproducto = public_path($imageName);

            if (file_exists($urlproducto)) {
            // Elimina la imagen del directorio
                unlink($urlproducto);
            }

            $imageName = time().'.'.$request->imagen1->extension();
            $request->imagen1->move(public_path('imagenes/productos/'), $imageName);
            $urlproducto = asset('imagenes/productos/'. $imageName);
        }else{
            $urlproducto = "";
        }
        // rempleza la imagen de la bd
        $request['imagen'] = $urlproducto;
        
        // actualiza los datos
        if($producto){
            DB::table('tbl_producto')->where('Cod_Producto', $Cod_Producto)->update($request->except(['_token','_method','imagen1']));
            return to_route('crudproductos');
        }else{
            return "no se pudo actulizar";
        }
    }
    
    // elimina Registros de los producto
    public function destroy($Cod_Producto)
    {
         // codigo para eliminar los datos
         $producto = DB::table('tbl_producto')->where('Cod_Producto', $Cod_Producto)->get();
         if($producto){
            $imagenUrl = $producto[0]->imagen;
            $urlComponentes = parse_url($imagenUrl);
            $imageName = $urlComponentes['path'];
            DB::table('tbl_producto')->where('Cod_Producto', $Cod_Producto)->delete();

        // codigo para borrar la imagen del directorio
            $urlproducto = public_path($imageName);

            // Verifica si el archivo existe antes de intentar eliminarlo
            if (file_exists($urlproducto)) {
                unlink($urlproducto);
            }

             return to_route('crudproductos')->with('success','se elimino el producto de manera existosa');
         }else{
             return "no se lograron eliminar los datos";
         }
    }

     //función para inactivar el producto
     public function inactive($Cod_Producto)
     {
         //Cambiar de estado al producto (inactivo)
         $producto = tbl_producto::findOrFail($Cod_Producto);
         $producto->estado = false;
         $producto->save();
 
         return redirect()->route('crudproductos')->with('success', 'Producto inactivado correctamente.');
     
     }
 
     //función para activar el producto
     public function active($Cod_Producto)
     {
         //Cambiar de estado al producto (activo)
         $producto = tbl_producto::findOrFail($Cod_Producto);
         $producto->estado = true;
         $producto->save();
 
         return redirect()->route('crudproductos')->with('success', 'Producto activado correctamente.');
     
     }
 

    public function pdf()
    {
        // obtiene todos los registros
        $productos = tbl_producto::all();
        $imageName = [];
        // obtener el paht de la imagen
        for ($i = 0; $i < count($productos); $i++) {
            $imagenUrl = $productos[$i]->imagen;
            // Hacer algo con $imagenUrl
            $urlComponentes = parse_url($imagenUrl);
            $imageName[] = $urlComponentes['path'];
        }
        // elimina el servidor de la url
        // return dd($imageName);
        // mostrar pdf
        $pdf = Pdf::loadView('pdf.pdfproductos',compact('productos','imageName'));
        // descarga el pdf
        return $pdf->download('producto.pdf');
    }

    public function buscar(Request $request){
        // funcion para buscar registros
        $searchTerm = $request->input('buscar');
        $resultados = tbl_producto::where('Nombre', 'LIKE', '%' . $searchTerm . '%')->paginate(3);
        
        // return $resultados;
        return view('buscar.BuscarProducto', compact('resultados','searchTerm')); 
    }
}
