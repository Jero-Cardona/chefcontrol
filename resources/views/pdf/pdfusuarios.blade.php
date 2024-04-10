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
<h1>Usuarios Registrados</h1>
<table border="1">
   <thead>
       <tr>
           <th>ID</th>
           <th>Tipo documento</th>
           <th>Nombre</th>
           <th>Apellido</th>
           <th>Telefono</th>
           <th>Rol</th>
       </tr>
   </thead>
   <tbody>
       @foreach ($usuarios as $usuario)
           <tr>
           <td>{{ $usuario->Id_Empleado }}</td>
           <td>{{ $usuario->tipo_documento }}</td>
           <td>{{ $usuario->Nombre }}</td>
           <td>{{ $usuario->Apellido }}</td>
           <td>{{ $usuario->Telefono }}</td>
           <td>{{ $usuario->TipoRol->Rol }}</td>
           </tr>
       @endforeach
   </tbody>
</table>
