@extends('layouts.app')
{{ session('confirm-producto')}}
@section('style')
    <link rel="stylesheet" href="{{ asset('/css/estilosProducto.css')}}">
@endsection
@section('content')
<body>
    <div class="contenedorFormRegistro">
        <div class="contenedorFormRegistro1">
            <div class="tituloRegistro">
                <h2>Nuevo Producto</h2>
            </div>
        {{-- formulario de registro de producto--}}
        <form action="{{route('producto.store')}}" enctype="multipart/form-data" method="POST" class="formularioRegistro">
            @csrf
            <div class="formRegistro">
                <input id="Cod_Producto" name="Cod_Producto" type="number" required>
                <label for="Cod_Producto">Identificador producto</label>
            </div>
            <div class="formRegistro">
                <input id="Nombre" name="Nombre" type="text" required>
                <label for="Nombre"> Nombre del producto</label>
            </div>
            <div class="formRegistro">
                <input id="imagen" name="imagen" type="file" required>
                <label for="imagen"></label>
            </div>
            <div class="formRegistro">
                <input id="Stock_Minimo" name="Stock_Minimo" type="number" required>
                <label for="Stock_Minimo"> Stock Minimo Receta</label>
            </div>
            <div class="formRegistro">
                <input id="Stock_Maximo" name="Stock_Maximo" type="number" required>
                <label for="Stock_Maximo"> Stock Maximo del Receta</label>
            </div>
            <div class="formRegistro">
                <input id="Fecha_Vencimento" name="Fecha_Vencimento" type="date" required>
                <label for="Fecha_Vencimento"></label>
            </div>
            <div class="formRegistro">
                <input id="Costo" name="Costo" type="number" required>
                <label for="Costo">Costo del producto</label>
            </div>
            <div class="form1Registro">
                <select id="Cod_Tipo" name="Cod_Tipo" required>
                    <option value="" disabled selected hidden>Tipo Producto</option>
                    <option value="1">Materia Prima</option>
                    <option value="2">Producto terminado (Receta)</option>
                </select>
            </div>
            <div class="formRegistro">
                <input id="Ubicacion" name="Ubicacion" type="text" required>
                <label for="Ubicacion">Ubicacion del producto</label>
            </div>
            <div class="form1Registro">
                <select id="Cod_UMedida" name="Cod_UMedida" required>
                    <option value="" disabled selected hidden>Medida del producto</option>
                    <option value="1">Gramos</option>
                    <option value="2">Kilos</option>
                    <option value="3">Libras</option>
                    <option value="4">Onzas</option>
                    <option value="5">Porcion</option>
                    <option value="6">Unidad</option>
                </select>
            </div>
            <div class="formRegistro">
                <input id="Precio_Venta" name="Precio_Venta" type="number" required>
                <label for="Precio_Venta">Precio de Venta</label>
            </div>
            <div class="formRegistro">
                <input id="Existencia" name="Existencia" type="number" required>
                <label for="Existencia">Existencia del producto</label>
            </div>
            <div class="formRegistro">
                <input id="IVA" name="IVA" type="number" required>
                <label for="IVA">Iva del producto</label>
            </div>
            <div class="formRegistro">
            </div>
            <div class="btn1Registro">
                <input type="submit" class="enviarRegistro">
            </div>
        </form>
    </div>
</div>
</body>
@endsection