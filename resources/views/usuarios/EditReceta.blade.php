@extends('layouts.app')
{{ session('confirm-producto')}}
@section('style')
    {{-- <link rel="stylesheet" href="{{ asset('/css/estilosProducto.css')}}"> --}}
@endsection
@section('content')
<body>
    {{session ('confirm-user')}}
        <div class="contenedorFormRegistro">
            <div class="contenedorFormRegistro1">
                <div class="tituloRegistro">
                    <h2>Actualizar Receta</h2>
                </div>
                {{-- formulario de recetas resposive --}}
                <form action="{{route('receta.update', $receta[0]->Id_Receta)}}" enctype="multipart/form-data" method="POST" class="formularioRegistro">
                    @csrf
                    @method('PUT')
                    <div class="formRegistro">
                        <input value="{{$receta[0]->Nombre }}" id="Nombre" name="Nombre" type="text" required>
                        <label for="Nombre"> Nombre Receta</label>
                    </div>
                    <div class="formRegistro">
                        <input value="{{$receta[0]->Descripcion }}" id="Descripcion" name="Descripcion" type="text" required>
                        <label for="Descripcion"> Descripcion Receta</label>
                    </div>
                    <div class="formRegistro">
                        <input value="{{$receta[0]->Costo_Total }}" id="Costo_Total" name="Costo_Total" type="text" required>
                        <label for="Costo_Total"> Costo Total de la Receta</label>
                    </div>
                    <div class="formRegistro">
                        <input value="{{$receta[0]->Contribucion }}" id="Contribucion" name="Contribucion" type="number" required>
                        <label for="Contribucion">Contribucion</label>
                    </div>
                    <div class="form1Registro">
                        <select value="{{$receta[0]->Estado}} "id="Estado" name="Estado" required>
                            <option value="" disabled selected hidden>Estado de la Receta {{$receta[0]->Estado}}</option>
                            <option value="1">Estandarizada (1)</option>
                            <option value="2">En Espera (2)</option>
                        </select>
                    </div>
                    <div class="formRegistro">
                        {{-- <img style="width: 200px" src="{{asset($receta[0]->imagen)}}" alt="imagen"> --}}
                        <div class="fileR">
                            <input id="imagen" name="imagen1" type="file" class="fileRI">
                            <p class="textoFile">Adjuntar archivo</p>
                            <label for="imagen"></label>
                        </div>
                    </div>
                   
                    <div class="btn1Registro">
                        <input type="submit" value="Guardar Cambios" class="enviarRegistro">
                    </div>
                </form>
            </div>
        </div>
        <footer class="footerLogin">
            <img class="logo1SenaLogin" src="{{asset('imagenes/proyecto/logoSena.png')}}">
            <p><b>Servicio nacional de aprendizaje <br>
                Centro de la Innovacion, agroindustria y aviacion</b></p>
            <img class="logo3Login" src="{{asset('imagenes/proyecto/logo.svg')}}">
        </footer>
</body>
@endsection