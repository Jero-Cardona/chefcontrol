<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pdf productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
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
        
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    .card {
        width: 300px;
        border: 1px solid #ccc;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        page-break-inside: avoid; /* Evitar que la tarjeta se divida entre páginas */
    }

    .card img {
        width: 100%;
        height: auto;
        display: block;
    }

    .card-content {
        padding: 20px;
    }

    .card-content h3 {
        margin-top: 0;
    }

    .card-content p {
        margin-bottom: 0;
    }

    .imagen {
        width: 400px;
        height: 500px;
        border: solid black 2px;
    }
</style>

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
    
    <h1>Registros Productos</h1>
    
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <img class="imagen" src="{{ public_path($imageName) }}" alt="Imagen"></td>
                    <div class="card-content">
                        <h3>Nombre: {{ $producto->Nombre }}</h3>
                        <p>Stock Maximo: {{ $producto->Stock_Maximo }}</p>
                        <p>Stock Minimo: {{ $producto->Stock_Minimo }}</p>
                        <p>Fecha Vencimiento: {{ $producto->Fecha_Vencimiento }}</p>
                        <p>Costo Total: $COP {{number_format( $producto->Costo, 0, '.',',' )}}</p>
                        <p>Tipo de Producto: {{ $producto->tipoProducto->Tipo }}</p>
                        <p>Ubicacion: {{ $producto->Ubicacion }}</p>
                        <p>Medida del Producto: {{ $producto->tipoMedida->Unidad_Medida }}</p>
                        <p>Precio de Venta: {{ $producto->Precio_Venta }}</p>
                        <p>Existencia del producto: {{ $producto->Existencia }}</p>
                        <p>Iva del Producto: {{ $producto->IVA }}</p>
                        @if ($producto->estado == true)
                        <p>Estado: Activo</p>
                        @else
                        <p>Estado: Desactivado</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <br>
        
    
</body>
</html>
