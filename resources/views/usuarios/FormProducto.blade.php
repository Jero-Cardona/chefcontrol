@extends('layouts.app')
@section('title','ChefControl | Nuevo producto')
{{ session('confirm-producto') }}
@section('content')
    <body>
        <div class="contenedorFormRegistro">
            <div class="contenedorFormRegistro1">
                <div class="tituloRegistro">
                    <h2>Nuevo producto</h2>
                </div>
                {{-- formulario de registro de producto --}}
                <form action="{{ route('producto.store') }}" enctype="multipart/form-data" method="POST"
                    class="formularioRegistro" id="form">
                    @csrf
                    <div class="formRegistro">
                        <input required id="Nombre" name="Nombre" type="text" value="{{ old('Nombre') }}">
                        <label for="Nombre"> Nombre del producto</label>
                        @error('Nombre')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formRegistro">
                        <div class="fileR">
                            <input id="imagen" name="imagen" type="file" class="fileRI" required>
                            <p class="textoFile">Adjuntar archivo</p>
                            <label for="imagen"></label>
                        </div>
                        @error('imagen')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formRegistro">
                        <input required id="Stock_Minimo" name="Stock_Minimo" type="number"
                            value="{{ old('Stock_Minimo') }}">
                        <label for="Stock_Minimo"> Stock mínimo</label>
                        @error('Stock_Minimo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formRegistro">
                        <input required id="Stock_Maximo" name="Stock_Maximo" type="number"
                            value="{{ old('Stock_Maximo') }}">
                        <label for="Stock_Maximo"> Stock máximo</label>
                        @error('Stock_Maximo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formRegistro">
                        <input required id="Fecha_Vencimento" name="Fecha_Vencimiento" type="date"
                            value="{{ old('Fecha_Vencimiento') }}">
                        <label for="Fecha_Vencimento"></label>
                        @error('Fecha_Vencimiento')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formRegistro">
                        <input required id="Costo" name="Costo" type="number" value="{{ old('Costo') }}">
                        <label for="Costo">Costo del producto</label>
                        @error('Costo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form1Registro">
                        <select id="Cod_Tipo" name="Cod_Tipo" value="{{ old('Cod_Tipo') }}">
                            <option value="" disabled selected hidden>Tipo Producto</option>
                            <option value="1" @if (old('Cod_Tipo') == '1') selected @endif>Insumo</option>
                            <option value="2" @if (old('Cod_Tipo') == '2') selected @endif>Producto terminado
                                (Receta)</option>
                        </select>
                        @error('Cod_Tipo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formRegistro">
                        <input required id="Ubicacion" name="Ubicacion" type="text" value="{{ old('Ubicacion') }}">
                        <label for="Ubicacion">Ubicación del producto</label>
                    </div>
                    <div class="form1Registro">
                        <select id="Cod_UMedida" name="Cod_UMedida" value="{{ old('Cod_UMedida') }}">
                            <option value="" disabled selected hidden>Medida del producto</option>
                            <option value="1" @if (old('Cod_UMedida') == '1') selected @endif>Gramos (g)</option>
                            <option value="2" @if (old('Cod_UMedida') == '2') selected @endif>Kilogramos (kg)</option>
                            <option value="3" @if (old('Cod_UMedida') == '3') selected @endif>Litros (l)</option>
                            <option value="4" @if (old('Cod_UMedida') == '4') selected @endif>Mililitro (ml)</option>
                            <option value="5" @if (old('Cod_UMedida') == '5') selected @endif>Centímetros cúbicos (cm³)</option>
                          
                        </select>
                        @error('Cod_UMedida')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formRegistro">
                        <input required id="Precio_Venta" name="Precio_Venta" type="number"
                            value="{{ old('Precio_Venta') }}">
                        <label for="Precio_Venta">Precio de venta</label>
                        @error('Precio_Venta')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formRegistro">
                        <input required id="Existencia" name="Existencia" type="number" value="{{ old('Existencia') }}">
                        <label for="Existencia">Existencia del producto</label>
                        @error('Existencia')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formRegistro">
                        <input required id="IVA" name="IVA" type="number" value="{{ old('IVA') }}">
                        <label for="IVA">IVA del producto</label>
                        @error('IVA')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- campo para el estado del producto --}}
                    <input type="hidden" value="1" name="estado">
                    <div class="btn1Registro">
                        <input type="submit" class="enviarRegistro">
                    </div>
                </form>
            </div>
        </div>
        <footer class="footerLogin">
            <img class="logo1SenaLogin" src="{{ asset('imagenes/proyecto/logoSena.png') }}">
            <p><b>Servicio nacional de aprendizaje <br>
                    Centro de la innovación, agroindustria y aviación</b></p>
            <img class="logo3Login" src="{{ asset('imagenes/proyecto/logo.svg') }}">
        </footer>
    </body>
@endsection
