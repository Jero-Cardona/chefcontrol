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
<h1>Registros Clientes</h1>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo documento</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Telefono</th>
            <th>Estado</th>

            <!-- Agrega más columnas según tus necesidades -->
        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente)
            <tr>
            <td>{{ $cliente->Id_Cliente }}</td>
            <td>{{ $cliente->Tipo_identificacion }}</td>
            <td>{{ $cliente->Nombre }}</td>
            <td>{{ $cliente->Apellido }}</td>
            <td>{{ $cliente->Telefono }}</td>
            <td>{{ $cliente->estado }}</td>
                <!-- Agrega más columnas según tus necesidades -->
            </tr>
        @endforeach
    </tbody>
</table>
