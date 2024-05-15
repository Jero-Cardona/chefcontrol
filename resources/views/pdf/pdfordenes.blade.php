<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $titulo }} - PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

               /* Estilos para el encabezado */
        .footerLogin {
            height: 160px;
            background-color: #dddddd;
            border-top: 1px solid black;
            width: 100%;
            padding: 10px;
        }

        .footerLogin table {
            width: 100%;
            height: 100%;
        }

        .footerLogin table td {
            vertical-align: middle;
            padding: 10px;
        }

        .footerLogin p {
            font-size: 15px;
            text-align: left;
            margin: 20px;
        }

        .logo1SenaLogin {
            height: 100px;
            width: 100px;
            margin: 10px;
            align-content: flex-end;
        }

        h1 {
            text-align: center;
        }
        
        p {
            text-align: left;
            margin: 0 0 15px 0;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            page-break-inside: avoid; /* Evitar que la tarjeta se divida entre páginas */
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .order {
            width: 48%;
            border: 1px solid #ddd;
            padding: 10px;
        }

        .order-details {
            margin-bottom: 10px;
        }

        .card h2 {
            width: 100%;
        }

        .card p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="footerLogin">
        <table>
            <tr>
                <td>
                    <p><b>Servicio nacional de aprendizaje <br>
                        Centro de la innovación, agroindustria y aviación</b></p>
                    </td>
                    <td><img class="logo1SenaLogin" src="{{ public_path('imagenes/proyecto/logoSena.png') }}"></td>
                {{-- <td style="text-align: right;"><img class="logo3Login" src="{{ public_path('imagenes/proyecto/logo.svg') }}"></td> --}}
            </tr>
        </table>
    </div>
    <h1>{{ $titulo }}</h1>
    <p>Este documento contiene un listado de las {{ $titulo }}.</p>
    @foreach ($ordenesPorCliente as $cliente => $ordenesDelCliente)
        <div class="card">
            <h2>Cliente: {{ $orden->cliente->Nombre .' ' .$orden->cliente->Apeliido}}</h2>
            @foreach ($ordenesDelCliente as $index => $orden)
                @if ($index % 2 == 0)
                    <div class="row">
                @endif
                <div class="order">
                    <div class="order-details">
                        <h3>Orden #{{$orden->Consecutivo}}</h3>
                        <p>Fecha:{{ $orden->Fecha }}</p>
                        <p>Cocinero responsable: {{ $orden->empleado->Nombre . ' ' . $orden->empleado->Apellido }}</p>
                        <p>Receta: {{ $orden->receta->Nombre }}</p>
                        <p>Cantidad: {{ $orden->cantidad }}</p>
                        @if ($orden->receta)
                            @php
                                $precioOrden = $orden->receta->Costo_Total * $orden->cantidad;
                                $precioFormato = number_format($precioOrden, 0, '.', ',');
                            @endphp
                            <p>Precio de la orden: {{ $precioFormato }}</p>
                        @endif
                    </div>
                    @if ($orden->detalles)
                    <h3>Detalles de la Orden</h3>
                    <p>Fecha Pedido: {{ $orden->detalles->Fecha_Pedido }}</h4>
                    <p>Presentación: {{ $orden->detalles->Presentacion }}</h4>
                    <hr>
                    @endif
                </div>
                @if ($index % 2 == 1 || $index == count($ordenesDelCliente) - 1)
        </div>
    @endif
    @endforeach
    </div>
    @endforeach
</body>
</html>
