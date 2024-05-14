<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $titulo }} - PDF</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        h1 { text-align: center; }
        p { text-align: center; margin: 0 0 15px 0; }
        .card { border: 1px solid #ccc; border-radius: 5px; margin-bottom: 15px; padding: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); }
        .row { display: flex; justify-content: space-between; margin-bottom: 15px; }
        .order { width: 48%; border: 1px solid #ddd; padding: 10px; }
        .order-details { margin-bottom: 10px; }
        .card h2 { width: 100%; }
        .card h5 { margin: 5px 0; }
    </style>
</head>
<body>
    <h1>{{ $titulo }}</h1>
    <p>Este documento contiene un listado de las {{ $titulo }}.</p>
    @foreach ($ordenesPorCliente as $cliente => $ordenesDelCliente)
        <div class="card">
            <h2>Cliente: {{ $cliente }}</h2>
            @foreach ($ordenesDelCliente as $index => $orden)
                @if ($index % 2 == 0)
                    <div class="row">
                @endif
                        <div class="order">
                            <div class="order-details">
                                <h5>Fecha:{{ $orden->Fecha }}</h5>
                                <h5>Cocinero responsable: {{ $orden->empleado->Nombre }}</h5>
                                <h5>Receta: {{ $orden->receta->Nombre }}</h5>
                                <h5>Cantidad: {{ $orden->cantidad }}</h5>
                                @if ($orden->receta)
                                    @php $precioOrden = $orden->receta->Costo_Total * $orden->cantidad; $precioFormato = number_format($precioOrden, 0, '.', ','); @endphp
                                    <h5>Precio de la orden: {{ $precioFormato }}</h5>
                        
                        
                                    @endif
                            </div>
                        </div>
                @if ($index % 2 == 1 || $index == count($ordenesDelCliente) - 1)
                    </div>
                @endif
            @endforeach
        </div>
    @endforeach
</body>
</html>