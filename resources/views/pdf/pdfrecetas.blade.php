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

        h2 {
            text-align: center;
        }

        p {
            text-align: justify;
            margin: 0 0 15px 0;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card img {
            max-width: 100%;
            height: auto;
            display: block;
            border-radius: 5px;
        }

        .card h3 {
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .card p {
            margin: 0;
        }
    </style>
</head>
<body>
    <h2>{{ $titulo }}</h2>
    <p>Este documento contiene un listado de las {{ $titulo }}. Aquí se detallan sus atributos y características principales.</p>

    @foreach ($recetas as $index => $receta)
    <div class="card">
        <img src="{{ public_path($imageName[$index]) }}" alt="Imagen de {{ $receta->Nombre }}">
        <h3>{{ $receta->Nombre }}</h3>
        <p>Descripción: {{ $receta->Descripcion }}</p>
        <p>Costo total: {{ $receta->Costo_Total }}</p>
        <p>Contribución: {{ $receta->Contribucion }}</p>
        <p>Estado: {{ $receta->Estado }}</p>
    </div>
    @endforeach
</body>
</html>
