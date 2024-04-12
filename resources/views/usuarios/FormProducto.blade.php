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
                <input required id="Nombre" name="Nombre" type="text" value="{{ old('Nombre') }}" >
                <label for="Nombre"> Nombre del producto</label>
                @error('Nombre')
                        <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="formRegistro">
                <input required id="imagen" name="imagen" type="file" value="{{old('imagen')}}" >
                <label for="imagen"></label>
                 @error('imagen')
                        <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="formRegistro">
                <input required id="Stock_Minimo" name="Stock_Minimo" type="number"  value="{{ old('Stock_Minimo') }}">
                <label for="Stock_Minimo"> Stock Minimo</label>
                 @error('Stock_Minimo')
                        <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="formRegistro">
                <input required id="Stock_Maximo" name="Stock_Maximo" type="number"  value="{{ old('Stock_Maximo') }}">
                <label for="Stock_Maximo"> Stock Maximo</label>
                 @error('Stock_Maximo')
                        <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="formRegistro">
                <input required id="Fecha_Vencimento" name="Fecha_Vencimiento" type="date" value="{{ old('Fecha_Vencimiento') }}">
                <label for="Fecha_Vencimento"></label>
                 @error('Fecha_Vencimiento')
                        <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="formRegistro">
                <input required id="Costo" name="Costo" type="number"  value="{{ old('Costo') }}">
                <label for="Costo">Costo del producto</label>
                 @error('Costo')
                        <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form1Registro">
                <select id="Cod_Tipo" name="Cod_Tipo"  value="{{ old('Cod_Tipo') }}">
                    <option value="" disabled selected hidden>Tipo Producto</option>
                    <option value="1"  @if(old('Cod_Tipo') == '1') selected @endif>Insumo</option>
                    <option value="2"  @if(old('Cod_Tipo') == '2') selected @endif>Producto terminado (Receta)</option>
                </select>
                 @error('Cod_Tipo')
                        <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="formRegistro">
                <input required id="Ubicacion" name="Ubicacion" type="text"  value="{{ old('Ubicacion') }}">
                <label for="Ubicacion">Ubicacion del producto</label>
            </div>
            <div class="form1Registro">
                <select id="Cod_UMedida" name="Cod_UMedida"  value="{{ old('Cod_UMedida') }}">
                    <option value="" disabled selected hidden>Medida del producto</option>
                    <option value="1"  @if(old('Cod_UMedida') == '1') selected @endif>Gramos</option>
                    <option value="2"  @if(old('Cod_UMedida') == '2') selected @endif>Kilos</option>
                    <option value="3"  @if(old('Cod_UMedida') == '3') selected @endif>Libras</option>
                    <option value="4"  @if(old('Cod_UMedida') == '4') selected @endif>Onzas</option>
                    <option value="5"  @if(old('Cod_UMedida') == '5') selected @endif>Porcion</option>
                    <option value="6"  @if(old('Cod_UMedida') == '6') selected @endif>Unidad</option>
                    <option value="7"  @if(old('Cod_UMedida') == '7') selected @endif>Mililitro</option>
                </select>
                 @error('Cod_UMedida')
                        <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="formRegistro">
                <input required id="Precio_Venta" name="Precio_Venta" type="number"  value="{{ old('Precio_Venta') }}">
                <label for="Precio_Venta">Precio de Venta</label>
                 @error('Precio_Venta')
                        <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="formRegistro">
                <input required id="Existencia" name="Existencia" type="number"  value="{{ old('Existencia') }}">
                <label for="Existencia">Existencia del producto</label>
                 @error('Existencia')
                        <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="formRegistro">
                <input required id="IVA" name="IVA" type="number"  value="{{ old('IVA') }}">
                <label for="IVA">Iva del producto</label>
                 @error('IVA')
                        <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="btn1Registro">
                <input type="submit" class="enviarRegistro">
            </div>
        </form>
    </div>
</div>
</body>
@endsection