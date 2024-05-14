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
</style>
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
<h1>Registro Cliente</h1>
<table border="1">
    <thead>
        <tr>
            <th>Documento</th>
            <th>Tipo documento</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Telefono</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
            <tr>
                <td>{{ $cliente->Id_Cliente }}</td>
                <td>{{ $cliente->Tipo_identificacion }}</td>
                <td>{{ $cliente->Nombre }}</td>
                <td>{{ $cliente->Apellido }}</td>
                <td>{{ $cliente->Telefono }}</td>
                <td>
                    @if ($cliente->estado == true)
                        Activo
                    @else
                        Inactivo
                    @endif
                </td>
            </tr>
    
    </tbody>
</table>
