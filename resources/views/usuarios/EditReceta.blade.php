@extends('layouts.app')
{{ session('confirm-producto') }}
@section('content')
    <body>
        {{ session('confirm-user') }}
        <div class="contenedorFormRegistro">
            <div class="contenedorFormRegistro1">
                <div class="tituloRegistro">
                    <h2>Actualizar receta</h2>
                </div>
                {{-- formulario de recetas resposive --}}
                <form action="{{ route('receta.update', $receta[0]->Id_Receta) }}" enctype="multipart/form-data" method="POST"
                    class="formularioRegistro">
                    @csrf
                    @method('PUT')
                    <div class="formRegistro">
                        <input value="{{ $receta[0]->Nombre }}" id="Nombre" name="Nombre" type="text" required>
                        <label for="Nombre"> Nombre receta</label>
                    </div>
                    <div class="formRegistro">
                        <div class="fileR">
                            <input id="imagen" name="imagen1" type="file" class="fileRI">
                            <p class="textoFile">Adjuntar archivo</p>
                            <label for="imagen"></label>
                        </div>
                    </div>
                    <div class="formRegistro">
                        <input value="{{ $receta[0]->Costo_Total }}" id="Costo_Total" name="Costo_Total" type="text"
                            required>
                        <label for="Costo_Total"> Costo total de la receta</label>
                    </div>
                    <div class="formRegistro">
                        <input value="{{ $receta[0]->Contribucion }}" id="Contribucion" name="Contribucion" type="number"
                            required>
                        <label for="Contribucion">Contribución</label>
                    </div>
                    <div class="form1Registro">
                        {{-- <select value="{{$receta[0]->Estado}} "id="Estado" name="Estado" required>
                            <option value="" disabled selected hidden>Estado de la receta {{$receta[0]->Estado}}</option>
                            <option value="1">Estandarizada (1)</option>
                            <option value="2">En espera (2)</option>
                        </select> --}}
                    </div>
                    <div class="formRegistroTextarea1">
                        <div class="formRegistro">
                            <textarea class="textarea" name="Descripcion" id="Descripcion" type="text" value="{{ old('Descripcion') }}" required></textarea>
                            <label class="labelTextarea" for="Descripcion"> Descripción Receta</label>
                            @error('Descripcion')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
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
