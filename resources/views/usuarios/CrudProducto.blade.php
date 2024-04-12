@extends('layouts.app')
@section('style')
     @endsection
     @section('content')
<a href="{{route('producto.pdf')}}"><input type="submit" value="descargar pdf" class="botones1"></a>
<div class="container">
    <div class="div1">
        <div class="div2">
            <div class="div3">
                <div class="divHeader">
                    <h3 class="titulo">Lista de Productos</h3>
                    <form class="buscador">
                        <input type="text" placeholder="Buscar">
                        <button>Buscar</button>
                    </form>
                </div>
                <div class="divBody">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Imagen</th>
                                <th>Stock min</th>
                                <th>Stock Max</th>
                                <th>Vencimiento</th>
                                <th>Costo</th>
                                <th>Tipo</th>
                                <th>Ubicacion</th>
                                <th>Medida</th>
                                <th>Precio</th>
                                <th>Existencia</th>
                                <th>Iva</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- registros de los productos --}}
                            @foreach ($productos as $producto)
                            <tr>
                                <td>{{ $producto->Nombre }}</td>
                                <td><img style="height: 100px; width: 100px; border-radius: 10px;" src="{{ $producto->imagen }}" alt="imagen"></td>
                                <td>{{ $producto->Stock_Minimo }}</td>
                                <td>{{ $producto->Stock_Maximo }}</td>
                                <td>{{ $producto->Fecha_Vencimiento }}</td>
                                <td>{{ $producto->Costo }}</td>
                                <td>{{ $producto->tipoProducto->Tipo }}</td>
                                <td>{{ $producto->Ubicacion }}</td>
                                <td>{{ $producto->tipoMedida->Unidad_Medida }}</td>
                                <td>{{ $producto->Precio_Venta }}</td>
                                <td>{{ $producto->Existencia }}</td>
                                <td>{{ $producto->IVA }}</td>

                                <td>
                                    <form action="{{ route('producto.destroy', ['Cod_Producto' => $producto->Cod_Producto, 'imagen'=> $producto->imageName]) }}" method="POST" class="crud-form">
                                        <a href="{{ route('producto.edit', $producto->Cod_Producto) }}" class="btnEditar">Editar</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btnEliminar" onclick="return confirm('¿Estás seguro de querer eliminar estos datos?')">Eliminar</button>
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