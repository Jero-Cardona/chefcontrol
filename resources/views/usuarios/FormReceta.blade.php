@extends('layouts.app')
@section('style')
{{-- en esta seccion irian los estilos necesarios para el archivo --}}
{{-- <link rel="stylesheet" href="{{ asset('/css/estilosProducto.css')}}"> --}}
@endsection
@section('content')
@auth
@if (session('success'))
     <div style="padding: 10px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; color: white; background-color: rgba(255, 102, 0); border-color: #f5c6cb;" role="alert">
        {{ session('success') }}
    </div>
@endif    
    <div class="contenedorFormRegistro">
        <div class="contenedorFormRegistro1">
            <div class="tituloRegistro">
                <h2>Nueva Receta</h2>
            </div>
                {{-- formulario de recetas resposive --}}
                <form action="{{route('receta.store')}}" enctype="multipart/form-data" method="POST" class="formularioRegistro" id="form">
                @csrf
                <div class="formRegistro">
                    <input id="Nombre" name="Nombre" type="text"  value="{{old('Nombre')}}" required>
                    <label for="Nombre"> Nombre Receta</label>
                     @error('Nombre')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="formRegistro">
                    <input name="Descripcion" id="Descripcion" type="text"  value="{{old('Descripcion')}}" required>
                    <label for="Descripcion"> Descripcion Receta</label>
                     @error('Descripcion')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="formRegistro">
                    <input id="Costo_Total" name="Costo_Total" type="text"  value="{{old('Costo_Total')}}" required>
                    <label for="Costo_Total"> Costo Total de la Receta</label>
                     @error('Costo_Total')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="formRegistro">
                    <input id="Contribucion" name="Contribucion" type="number"  value="{{old('Contribucion')}}" required>
                    <label for="Contribucion">Contribucion</label>
                    @error('Contribucion')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                @if (Auth::user()->Id_Rol == '1')
                <div class="form1Registro">
                    <select id="Estado" name="Estado"  value="{{old('Estado')}}" required>
                        <option value="" disabled selected hidden>Estado de la Receta</option>
                        <option value="1" @if(old('Estado') == '1') selected @endif>Estandarizada</option>
                        <option value="2" @if(old('Estado') == '2') selected @endif>En Espera</option>
                    </select>
                     @error('Estado')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>    
                @else
                <div class="form1Registro">
                    <input type="hidden" name="Estado" id="Estado" value="2">
                </div>
                @endif
                
                <div class="formRegistro">
                    <div class="fileR">
                        <input id="imagen" name="imagen" type="file" class="fileRI">
                        <p class="textoFile">Adjuntar archivo</p>
                        <label for="imagen"></label>
                    </div>
                    @error('imagen')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    {{-- campo para el manejo de estados --}}
                    <input name="etapa" type="hidden" value="1"  >
                </div>
                <div class="btn1Registro">
                    <input type="submit" class="enviarRegistro">
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
    @endauth
@endsection