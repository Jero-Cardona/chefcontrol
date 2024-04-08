<?php

namespace App\Http\Controllers;

use App\Models\tbl_producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;



class TblProductoController extends Controller
{
    // Retorna el crud 
    public function index()
    {
        $productos = tbl_producto::all();
        return view('usuarios.CrudProducto',compact('productos'));
    }

    //Carga el formulario desde el directorio de Usuario
    public function create(){
        return view('usuarios.FormProducto');
    }

    // Almacena los datos en la Base de Datos
    public function store(Request $request)
    {
        // codigo de validacion
        $request->validate([
            'Cod_Producto'=>'required',
            'Nombre'=>'required',
            'imagen'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Stock_Minimo'=>'required',
            'Stock_Maximo'=>'required',
            'Fecha_Vencimiento'=>'date',
            'Costo'=>'required',
            'Cod_Tipo'=>'required',
            'Ubicacion'=>'required',
            'Cod_UMedida'=>'required',
            'Precio_Venta'=>'required',
            'Existencia'=>'required',
            'IVA'=>'required'
        ]);
        
        // condicional de imagen
        if($request->hasFile('imagen')){
            $imageName = time().'.'.$request->imagen->extension();
            $request->imagen->move(public_path('imagenes/productos/'), $imageName);
            $urlproducto = asset('imagenes/productos/'. $imageName);
        }else{
            $urlproducto = "";
        }

        // Instancia de la clase Producto
        $producto = new tbl_producto;
        $producto->Cod_Producto = $request->Cod_Producto;
        $producto->Nombre = $request->Nombre;
        $producto->imagen = $urlproducto;
        $producto->Stock_Minimo = $request->Stock_Minimo;
        $producto->Stock_Maximo = $request->Stock_Maximo;
        $producto->Fecha_Vencimiento = $request->Fecha_Vencimento;
        $producto->Costo = $request->Costo;
        $producto->Cod_Tipo = $request->Cod_Tipo;
        $producto->Ubicacion = $request->Ubicacion;
        $producto->Cod_UMedida = $request->Cod_UMedida;
        $producto->Precio_Venta = $request->Precio_Venta;
        $producto->Existencia = $request->Existencia;
        $producto->IVA = $request->IVA;

        if($producto){
            $producto->save();
            session()->flash('confirm-producto','El producto ha sido registrado correctamente');
            return to_route('usuarios.index');
        }else{
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

    public function pdf()
    {
        $productos = tbl_producto::all();
        // mostrar pdf
        $pdf = Pdf::loadView('pdf.pdfproductos',compact('productos'));
        // descarga el pdf
        return $pdf->download('producto.pdf');
        
        // // Ejemplo usando el método header()
        // $response = Response::make($pdf);
        // $response->header('Content-Type', 'application/pdf');
        // return $response;

        // // Ejemplo usando el método header() de la respuesta de Laravel
        // return response($pdf)->header('Content-Type', 'application/pdf');
    }
}
