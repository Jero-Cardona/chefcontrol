@extends('layouts.app')
@section('title','ChefControl | Editar producto')
{{ session('confirm-producto') }}
@section('content')
    <body>
        <div class="contenedorFormRegistro">
            <div class="contenedorFormRegistro1">
                <div class="tituloRegistro">
                    <h2>Actualizar producto</h2>
                </div>
                {{-- formulario de registro de producto --}}
                <form action="{{ route('producto.update', $producto[0]->Cod_Producto) }}" enctype="multipart/form-data"
                    method="POST" class="formularioRegistro">
                    @method('PUT')
                    @csrf
                    <div class="formRegistro">
                        <input value="{{ $producto[0]->Nombre }}" id="Nombre" name="Nombre" type="text" required>
                        <label for="Nombre">Nombre del producto</label>
                    </div>
                    <div class="formRegistro">
                        <div class="fileR">
                            <input id="imagen1" name="imagen1" type="file" class="fileRI" required>
                            <p class="textoFile">Adjuntar archivo</p>
                            <label for="imagen1"></label>
                        </div>
                    </div>
                    <div class="formRegistro">
                        <input value="{{ $producto[0]->Stock_Minimo }}" id="Stock_Minimo" name="Stock_Minimo" type="number"
                            required>
                        <label for="Stock_Minimo"> Stock mínimo producto</label>
                    </div>
                    <div class="formRegistro">
                        <input value="{{ $producto[0]->Stock_Maximo }}" id="Stock_Maximo" name="Stock_Maximo" type="number"
                            required>
                        <label for="Stock_Maximo"> Stock Máximo producto</label>
                    </div>
                    <div class="formRegistro">
                        <input value="{{ $producto[0]->Fecha_Vencimiento }}" id="Fecha_Vencimento" name="Fecha_Vencimiento"
                            type="date" required>
                        <label for="Fecha_Vencimento"></label>
                    </div>
                    <div class="formRegistro">
                        <input value="{{ $producto[0]->Costo }}" id="Costo" name="Costo" type="number" required>
                        <label for="Costo">Costo del producto</label>
                    </div>
                    <div class="form1Registro">
                        <select value="{{ $producto[0]->Cod_Tipo }}" id="Cod_Tipo" name="Cod_Tipo" required>
                            <option value="" disabled selected hidden>{{ $producto[0]->Cod_Tipo }}</option>
                            <option value="1">Materia prima (1)</option>
                            <option value="2">Producto terminado (2)</option>
                        </select>
                    </div>
                    <div class="formRegistro">
                        <input value="{{ $producto[0]->Ubicacion }}" id="Ubicacion" name="Ubicacion" type="text"
                            required>
                        <label for="Ubicacion">Ubicación del producto</label>
                    </div>
                    <div class="form1Registro">
                        <select value="{{ $producto[0]->Cod_UMedida }}" id="Cod_UMedida" name="Cod_UMedida" required>
                            <option value="" disabled selected hidden>{{ $producto[0]->Cod_UMedida }}</option>
                            <option value="1">Gramos</option>
                            <option value="2">Kilos</option>
                            <option value="3">Libras</option>
                            <option value="4">Onzas</option>
                            <option value="5">Porción</option>
                            <option value="6">Unidad</option>
                            <option value="7">Litros</option>
                            <option value="8">Mililitros</option>
                        </select>
                    </div>
                    <div class="formRegistro">
                        <input value="{{ $producto[0]->Precio_Venta }}" id="Precio_Venta" name="Precio_Venta"
                            type="number" required>
                        <label for="Precio_Venta">Precio de venta</label>
                    </div>
                    <div class="formRegistro">
                        <input value="{{ $producto[0]->Existencia }}" id="Existencia" name="Existencia" type="number"
                            required>
                        <label for="Existencia">Existencia del producto</label>
                    </div>
                    <div class="formRegistro">
                        <input value="{{ $producto[0]->IVA }}" id="IVA" name="IVA" type="number" required>
                        <label for="IVA">IVA del producto</label>
                    </div>

                    <div class="btn1Registro">
                        <input type="submit" value="Guardar Cambios" class="enviarRegistro">
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
