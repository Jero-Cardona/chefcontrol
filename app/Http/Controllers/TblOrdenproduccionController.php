<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\tbl_ordenproduccion;
use App\Models\tbl_cliente;
use App\Models\tbl_detalleordenproduccion;
use App\Models\tbl_receta;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class TblOrdenproduccionController extends Controller
{
    // constructor para los middleware
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
        $this->middleware('AdminRol', ['only' => ['edit', 'update', 'active', 'inactive']]);
    }


    public function storeDetalles(Request $request, $ordenId)
    {
        $orden = tbl_ordenproduccion::findOrFail($ordenId);

        $detalle = new tbl_detalleordenproduccion();
        $detalle->Consecutivo = $orden->Consecutivo;
        $detalle->Fecha_Pedido = $request->input('Fecha_Pedido');
        $detalle->Presentacion = $request->input('Presentacion');
        $detalle->save();

        return redirect()->back()->with('ordenes', 'Detalle agregado correctamente.');
    }

    public function storeBulkDetalles(Request $request)
    {

        $fechaPedido = $request->input('Fecha_Pedido');
        $presentacion = $request->input('Presentacion');
        $recetasSeleccionadas = $request->input('recetas', []);

        foreach ($recetasSeleccionadas as $consecutivo) {
            $orden = tbl_ordenproduccion::findOrFail($consecutivo);

            $detalle = new tbl_detalleordenproduccion();
            $detalle->Consecutivo = $orden->Consecutivo;
            $detalle->Fecha_Pedido = $fechaPedido;
            $detalle->Presentacion = $presentacion;
            $detalle->save();
        }
        return redirect()->back()->with('ordenes', 'Detalles agregados correctamente.');
    }

    public function create()
    {
        $fechaActual = Carbon::now();
        $recetas = tbl_receta::where('etapa', true)
        ->where('Estado', 1)->get();
        $clientesActivos = tbl_cliente::where('estado', true)->get();

        return view('usuarios.OrdenProduccion', compact('recetas', 'clientesActivos', 'fechaActual'));
    }

    public function store(Request $request)
    {
        date_default_timezone_set('America/Bogota');

        // codigo de validacion formulario desde el backend
        $request->validate([
            'Fecha' => ['required', 'date_format:Y-m-d H:i:s'],
            'Id_Cliente' => 'required',
            'Id_Empleado' => 'required',
            'Id_Receta' => 'required',
            'cantidad' => 'required',
            'estado' => 'required'
        ]);


        $fecha = $request->input('Fecha');

        // Crear una instancia de Carbon para obtener la fecha y hora actual
        $fechaActual = Carbon::createFromFormat('Y-m-d H:i:s', $fecha);

        // se instancia la clase
        $produccion = new tbl_ordenproduccion;
        $produccion->Fecha = $fechaActual;
        $produccion->Id_Cliente = $request->Id_Cliente;
        $produccion->Id_Empleado = $request->Id_Empleado;
        $produccion->Id_Receta = $request->Id_Receta;
        $produccion->cantidad = $request->cantidad;
        $produccion->estado = $request->estado;

        // $produccion->imagen = $urlreceta;
        $produccion->save();

        // retorna a la vista de las recetas
        return to_route('orden.produccion');
    }

    public function iniciarPreparacion($ordenId)
    {
        $orden = tbl_ordenproduccion::findOrFail($ordenId);
        $orden->estado = 'En preparación';
        $orden->save();

        return redirect()->back()->with('ordenes', 'Estado de la orden actualizado a En preparación');
    }
    public function marcarComoEntregado($ordenId)
    {
        $orden = tbl_ordenproduccion::findOrFail($ordenId);
        $orden->estado = 'Entregado';
        $orden->save();

        return redirect()->back()->with('ordenes', 'La orden ha sido marcada como entregada.');
    }

    public function indexOrdenesEspera()
    {
        // Obtener todas las órdenes en espera
        $ordenesEnEspera = tbl_ordenproduccion::where('estado', 'En espera')->get();
        $ordenesPorCliente = tbl_ordenproduccion::with(['cliente', 'receta', 'detalles'])
            ->where('estado', 'En espera')
            ->paginate(6);

        // Obtener los Consecutivos de las órdenes que tienen detalles
        $ordenesConDetalles = tbl_detalleordenproduccion::pluck('Consecutivo')->toArray();

        return view('usuarios.ordenesEspera', compact('ordenesPorCliente', 'ordenesEnEspera', 'ordenesConDetalles'));
    }

    public function indexOrdenesPreparacion()
    {
        $ordenesEnPreparacion = tbl_ordenproduccion::where('estado', 'En preparación')->paginate(6);
        return view('usuarios.ordenesPreparacion', compact('ordenesEnPreparacion'));
    }

    public function indexOrdenesEntegadas()
    {
        $ordenesEntregadas = tbl_ordenproduccion::where('estado', 'Entregado')->paginate(6);
        return view('usuarios.ordenesEntregadas', compact('ordenesEntregadas'));
    }

    public function editDetalles($ordenId)
    {
        $orden = tbl_ordenproduccion::findOrFail($ordenId);
        return view('usuarios.EditDetalle', compact('orden'));
    }

    public function updateDetalles(Request $request, $ordenId)
    {
        $orden = tbl_ordenproduccion::findOrFail($ordenId);
        $detalles = $orden->detalles;

        $detalles->Fecha_Pedido = $request->input('Fecha_Pedido');
        $detalles->Presentacion = $request->input('Presentacion');
        $detalles->save();

        return redirect()->route('receta.recetario')->with('ordenes', 'Detalle actualizado correctamente.');
    }

    public function buscar(Request $request, $buscar)
    {

        if ($buscar == 1) {
            // ordenes en espera
            $ordenesEnEspera = tbl_ordenproduccion::where('estado', 'En espera')->get();
            // funcion para buscar registros de las ordenes
            $searchTerm = $request->input('buscar');
            $resultados = tbl_ordenproduccion::with(['cliente', 'receta', 'detalles'])
                ->where('estado', 'En espera')  // Esta condición siempre debe ser cumplida
                ->where(function ($query) use ($searchTerm) {  // Usamos un agrupamiento lógico para encapsular los OR
                    $query->whereHas('cliente', function ($subQuery) use ($searchTerm) {
                        $subQuery->where('Nombre', 'LIKE', '%' . $searchTerm . '%');
                    });
                    $query->orWhereHas('receta', function ($subQuery) use ($searchTerm) {
                        $subQuery->where('Nombre', 'LIKE', '%' . $searchTerm . '%');
                    });
                })
                ->get()
                ->groupBy(function ($orden) {
                    return $orden->cliente->Nombre;  // Agrupa por el nombre del cliente
                });

            if ($resultados->isEmpty()) {
                return redirect()->route('ordenes.espera')
                    ->with('mensaje', '¡No se encuentra!');
            } else {
                return view('buscar.BuscarOrdenEspera', compact('resultados', 'searchTerm', 'ordenesEnEspera', 'buscar'));
            }
        } elseif ($buscar == 2) {
            // ordenes en Preparacion
            $ordenesPreparacion = tbl_ordenproduccion::where('estado', 'En preparacion')->get();
            // funcion para buscar registros de las ordenes
            $searchTerm = $request->input('buscar');
            $resultados = tbl_ordenproduccion::with(['cliente', 'receta', 'detalles'])
                ->where('estado', 'En preparacion')
                ->where(function ($query) use ($searchTerm) {  // Usamos un agrupamiento lógico para encapsular los OR
                    $query->whereHas('cliente', function ($subQuery) use ($searchTerm) {
                        $subQuery->where('Nombre', 'LIKE', '%' . $searchTerm . '%');
                    });
                    $query->orWhereHas('receta', function ($subQuery) use ($searchTerm) {
                        $subQuery->where('Nombre', 'LIKE', '%' . $searchTerm . '%');
                    });
                })
                ->get();

            if ($resultados->isEmpty()) {
                return redirect()->route('ordenes.preparacion')
                    ->with('mensaje', '¡No se encuentra!');
            } else {
                return view('buscar.BuscarOrdenPreparacion', compact('resultados', 'ordenesPreparacion', 'searchTerm', 'buscar'));
            }
        } else {
            // ordenes en Preparacion
            $ordenesEntregadas = tbl_ordenproduccion::where('estado', 'Entregado')->get();
            // funcion para buscar registros de las ordenes
            $searchTerm = $request->input('buscar');
            $resultados = tbl_ordenproduccion::with(['cliente', 'receta', 'detalles'])
                ->where('estado', 'Entregado')
                ->where(function ($query) use ($searchTerm) {  // Usamos un agrupamiento lógico para encapsular los OR
                    $query->whereHas('cliente', function ($subQuery) use ($searchTerm) {
                        $subQuery->where('Nombre', 'LIKE', '%' . $searchTerm . '%');
                    });
                    $query->orWhereHas('receta', function ($subQuery) use ($searchTerm) {
                        $subQuery->where('Nombre', 'LIKE', '%' . $searchTerm . '%');
                    });
                })
                ->get();

            if ($resultados->isEmpty()) {
                return redirect()->route('ordenes.entregadas')
                    ->with('mensaje', '¡No se encuentra!');
            } else {
                return view('buscar.BuscarOrdenEntregada', compact('resultados', 'ordenesEntregadas', 'searchTerm', 'buscar'));
            }
        }
    }


    public function pdf($button_id)
    {
        if ($button_id == 1) {
            $ordenes = tbl_ordenproduccion::where('estado', 'En espera')->get();
            $titulo = 'Órdenes en espera';
        } elseif ($button_id == 2) {
            $ordenes = tbl_ordenproduccion::where('estado', 'En preparación')->get();
            $titulo = 'Órdenes en preparación';
        } else {
            $ordenes = tbl_ordenproduccion::where('estado', 'Entregado')->get();
            $titulo = 'Órdenes entregadas';
        }

        $ordenesPorCliente = $ordenes->groupBy(function ($orden) {
            return $orden->cliente->Nombre; // Agrupa por el nombre del cliente
        });

        $pdf = Pdf::loadView('pdf.pdfordenes', compact('ordenes', 'titulo', 'ordenesPorCliente'));
        return $pdf->download($titulo . '.pdf');
    }

    public function pdfunico($ordenId, $button)
    {
        if ($button == 1) {
            $orden = tbl_ordenproduccion::where('Consecutivo', $ordenId)
                ->where('estado', 'En espera')
                ->firstOrFail();
            $titulo = 'Orden de produccion en espera';
        } elseif ($button == 2) {
            $orden = tbl_ordenproduccion::where('Consecutivo', $ordenId)
                ->where('estado', 'En preparación')
                ->firstOrFail();
            $titulo = 'Orden de produccion en preparacion';
        } else {
            $orden = tbl_ordenproduccion::where('Consecutivo', $ordenId)
                ->where('estado', 'Entregado')
                ->firstOrFail();
            $titulo = 'Orden de produccion entregada';
        }

        $pdf = PDF::loadView('pdf.pdforden', compact('orden', 'titulo'));
        return $pdf->download($titulo . '.pdf');
    }
}
