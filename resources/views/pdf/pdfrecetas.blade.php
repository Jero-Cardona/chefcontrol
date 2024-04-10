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
<h1>Registros Recetas</h1>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descipcion</th>
            <th>Costo T</th>
            <th>Aporte</th>
            <th>Estado</th>
            <th>imagen</th>
            <!-- Agrega más columnas según tus necesidades -->
        </tr>
    </thead>
    <tbody>
        @foreach ($recetas as $receta)
            <tr>
                <td>{{ $receta->Id_Receta }}</td>
                <td>{{ $receta->Nombre }}</td>
                <td>{{ $receta->Descripcion }}</td>
                <td>{{ $receta->Costo_Total }}</td>
                <td>{{ $receta->Contribucion }}</td>
                <td>{{ $receta->Estado }}</td>
                <td><img src="{{ asset('imagenes/recetas' . $receta->urlreceta) }}" alt="Imagen"></td>
                <!-- Agrega más columnas según tus necesidades -->
            </tr>
        @endforeach
    </tbody>
</table>
