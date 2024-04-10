@extends('layouts.app')
@section('style')
     <link rel="stylesheet" href="{{asset('/css/estiloCrudProducto.css')}}">
     @endsection
     @section('content')
<div class="contenedor1CrudP">
    <div class="div1CrudP">
        <div class="div2CrudP">
            <div class="div3CrudP">
                <div class="divHeaderCrudP">
                    <h3 class="titulo1CrudP">Lista de Productos</h3>
                    <form action="#" class="buscadorCrudP">
                        @csrf
                        <input type="text" name="buscar" placeholder="¿Qué desea buscar?">
                        <button>Buscar</button>
                    </form>
                </div>
                <div class="divBodyCrudP">
                    <table class="tableCrudP">
                        <thead>
                            <tr>
                                
                                <th>Nombres</th>
                                <th>Imagen</th>
                                <th>Stock min</th>
                                <th>Sotck max</th>
                                <th>Vencimento</th>
                                <th>Costo</th>
                                <th>Tipo P</th>
                                <th>Ubicacion</th>
                                <th>Medida</th>
                                <th>Precio</th>
                                <th>Existencia</th>
                                <th>Iva</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($productos as $producto)
                            <tr>
                                
                                <td>{{ $producto->Nombre }}</td>
                                <td><img style="height: 100px; width: 100px; border-radius: 10px;" src="{{ $producto->imagen }}" alt="imagen"></td>
                                <td>{{ $producto->Stock_Minimo }}</td>
                                <td>{{ $producto->Stock_Maximo }}</td>
                                <td>{{ $producto->Fecha_Vencimiento}}</td>
                                <td>{{ $producto->Costo }}</td>
                                <td>{{ $producto->tipoProducto->Tipo }}</td>
                                <td>{{ $producto->Ubicacion }}</td>
                                <td>{{ $producto->tipoMedida->Unidad_Medida }}</td>
                                <td>{{ $producto->Precio_Venta }}</td>
                                <td>{{ $producto->Existencia }}</td>
                                <td>{{ $producto->IVA }}</td>
                                <td>
                                    <form action="{{ route('producto.destroy', ['Cod_Producto' => $producto->Cod_Producto, 'imagen'=> $producto->imageName]) }}" method="POST" class="crud-form">
                                        <a href="{{ route('producto.edit', $producto->Cod_Producto) }}" class="editarCrudP">Editar</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="eliminarCrudP" onclick="return confirm('¿Estás seguro de querer eliminar estos datos?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection