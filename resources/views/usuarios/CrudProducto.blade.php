@extends('layouts.app')
@section('content')
<a href="{{route('producto.pdf')}}"><input type="submit" value="descargar pdf" class="botones1"></a>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Productos</h3>
                </div>
                <div class="card-body">
                    <table class="table">
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
                                    <form action="{{ route('producto.destroy', ['Cod_Producto' => $producto->Cod_Producto, 'imagen'=> $producto->imageName]) }}" method="POST">
                                        <a href="{{ route('producto.edit', $producto->Cod_Producto) }}" class="btn btn-sm btn-primary">Editar Datos</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de querer eliminar estos datos?')">Eliminar</button>
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