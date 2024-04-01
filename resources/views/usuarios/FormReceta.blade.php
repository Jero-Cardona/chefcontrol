@extends('layouts.app')
{{ session('confirm-receta') }}
@section('style')
{{-- en esta seccion irian los estilos necesarios para el archivo --}}
<link rel="stylesheet" href="{{ asset('/css/estilosProducto.css')}}">
@endsection
@section('content')
<body>
    <div class="contenedorFormRegistro">
        <div class="contenedorFormRegistro1">
            <div class="tituloRegistro">
                <h2>Nueva Receta</h2>
            </div>
            {{-- formulario de recetas resposive --}}
            <form action="{{route('receta.store')}}" enctype="multipart/form-data" method="POST" class="formularioRegistro">
                @csrf
                <div class="formRegistro">
                    <input id="Id_Receta" name="Id_Receta" type="number" required>
                    <label for="Id_Receta">Identificador Receta</label>
                </div>
                <div class="formRegistro">
                    <input id="Nombre" name="Nombre" type="text" required>
                    <label for="Nombre"> Nombre Receta</label>
                </div>
                <div class="formRegistro">
                    <input name="Descripcion" id="Descripcion" type="text" required>
                    <label for="Descripcion"> Descripcion Receta</label>
                </div>
                <div class="formRegistro">
                    <input id="Costo_Total" name="Costo_Total" type="text" required>
                    <label for="Costo_Total"> Costo Total de la Receta</label>
                </div>
                <div class="formRegistro">
                    <input id="Contribucion" name="Contribucion" type="number" required>
                    <label for="Contribucion">Contribucion</label>
                </div>
                <div class="form1Registro">
                    <select id="Estado" name="Estado" required>
                        <option value="" disabled selected hidden>Estado de la Receta</option>
                        <option value="1">Estandarizada</option>
                        <option value="2">En Espera</option>
                    </select>
                </div>
                <div class="formRegistro">
                    <input id="imagen" name="imagen" type="file" required>
                    <label for="imagen"></label>
                </div>
                <div class="formRegistro">
                    <input id="" name="" type="hidden">
                </div>
                <div class="btn1Registro">
                    <input type="submit" class="enviarRegistro">
                </div>
            </form>
        </div>
    </div>
        {{ session('confirm-receta') }}
        <div class="contenedorFormRegistro">
            <div class="contenedorFormRegistro1">
                <div class="tituloRegistro">
                    <h2>Detalle de Receta</h2>
                </div>
                {{-- formulario de detalle receta resposive recetas resposive --}}
                <form action="{{route('detalleReceta.store')}}" enctype="multipart/form-data" method="POST" class="formularioRegistro">
                    @csrf
                    <div class="formRegistro">
                        <input id="Id_Receta" name="Id_Receta" type="number" required>
                        <label for="Id_Receta">Identificador Receta</label>
                    </div>
                    <div class="formRegistro">
                        <input id="Cod_Producto" name="Cod_Producto" type="number" required>
                        <label for="Cod_Producto"> Codigo del Producto</label>
                    </div>
                    <div class="formRegistro">
                        <input name="Cantidad" id="Cantidad" type="text" required>
                        <label for="Cantidad"> Cantidad del producto</label>
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
                            <option value="7">Mililitro</option>
                        </select>
                    </div>
                    <div class="btn1Registro">
                        <input type="submit" value="Enviar Detalle" class="enviarRegistro">
                    </div>
                </form>
            </div>
        </div>
        @endsection