<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$titulo}} pdf</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
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
        .card {
        width: 300px;
        border: 1px solid #ccc;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .card img {
            width: 100%;
            height: 150px;
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
        .imagen{
            width: 400px;
            height: 500px;
            border: solid black 2px;
        }
    </style>
<body>
    <?php
    $i = 0;
    ?>
    <h2>Registros de las {{$titulo}}</h2>
    <p>El siguiente documento pdf contiene un listado de todos 
        los registros que hay en el aplicativo hasta el momento, 
        dichos registros se hacen apartir bajo el uso del sistema y sus diferentes formularios</p>
    @foreach ($recetas as $receta)
    <div class="row">
        <div class="col-md-6">
        <div class="card">
                <img class="imagen" src="{{ public_path($imageName[$i]) }}" alt="Imagen"></td>
            <div class="card-content">
                <h3>Nombre: {{ $receta->Nombre }}</h3>
                <p>Descripcion de la Receta: {{ $receta->Descripcion }}</p>
                <p>Costo Total de la Receta: {{ $receta->Costo_Total }}</p>
                <p>Contribucion: {{ $receta->Contribucion }}</p>
                <p>Estado de la Receta: {{ $receta->Estado }}</p>
            </div>
        </div>
    </div>
    </div>
    <br>
    <?php
    $i++;
    ?>
    @endforeach
</body>
</html>
