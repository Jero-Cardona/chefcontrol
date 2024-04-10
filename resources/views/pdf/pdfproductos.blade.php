<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pdf productos</title>
    <style>
        table{
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        th,td{
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even){
            background-color: #dddddd;
        }
    </style>
</head>
<body>
    <h1>Registros Productos</h1>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Imagen</th>
            <th>S Maximo</th>
            <th>S Minimo</th>
            <th>Fecha V</th>
            <th>Costo</th>
            <th>Tipo</th>
            <th>Ubicacion</th>
            <th>Medida</th>
            <th>Precio</th>
            <th>Existencia</th>
            <th>Iva</th>
            <!-- Agrega más columnas según tus necesidades -->
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $producto)
        <tr> 
            <th>{{ $producto->Cod_Producto }}</th>
            <th>{{ $producto->Nombre }}</th>
            <td><img src="{{ public_path('imagenes/productos' . $producto->imagen) }}" alt="Producto"></td>
                <th>{{ $producto->Stock_Minimo }}</th>
                <th>{{ $producto->Stock_Maximo }}</th>
                <th>{{ $producto->Fecha_Vencimiento}}</th>
                <th>{{ $producto->Costo }}</th>
                <th>{{ $producto->tipoProducto->Tipo }}</th>
                <th>{{ $producto->Ubicacion }}</th>
                <th>{{ $producto->tipoMedida->Unidad_Medida }}</th>
                <th>{{ $producto->Precio_Venta }}</th>
                <th>{{ $producto->Existencia }}</th>
                <th>{{ $producto->IVA }}</th>
                <!-- Agrega más columnas según tus necesidades -->
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
