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
            page-break-inside: avoid; /* Evitar que la tarjeta se divida entre páginas */
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
    <h2>{{ $titulo }}</h2>
    <p>Este documento contiene los detalles de la receta seleccionada: {{ $receta->Nombre }}.</p>

    <div class="card">
        <img src="{{ public_path($imageName) }}" alt="Imagen de {{ $receta->Nombre }}">
        <h3>{{ $receta->Nombre }}</h3>
        <p>Descripción: {{ $receta->Descripcion }}</p>
        <p>Costo total: {{ number_format($receta['Costo_Total'], 0, '.', ',') }}</p>
        <p>Contribución: {{ $receta->Contribucion }}</p>
        @if($receta->Estado == 1)
        <p>Estado: Estandarizada</p>
        @else
        <p>Estado: En espera</p>
        @endif
    
        @if($receta->etapa == true)
        <p>Etapa: Activo</p>
        @else
        <p>Etapa: Desactivado</p>
        @endif
    </div>
</body>
</html>
