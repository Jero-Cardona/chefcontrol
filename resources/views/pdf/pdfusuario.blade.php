<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        page-break-inside: avoid; /* Evitar que la tarjeta se divida entre páginas */
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
<h1>Usuarios Registrados</h1>
<table border="1">
    <thead>
        <tr>
            <th>Documento</th>
            <th>Tipo documento</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Telefono</th>
            <th>Rol</th>
            <th>Estado</th>
            
        </tr>
    </thead>
    <tbody>
        
            <tr>
                <td>{{ $usuario->Id_Empleado }}</td>
                <td>{{ $usuario->tipo_documento }}</td>
                <td>{{ $usuario->Nombre }}</td>
                <td>{{ $usuario->Apellido }}</td>
                <td>{{ $usuario->Telefono }}</td>
                <td>{{ $usuario->TipoRol->Rol }}</td>
                <td>
                    @if ($usuario->estado == true)
                        Activo
                    @else
                        Inactivo
                    @endif
                </td>
            </tr>
        
    </tbody>
</table>
