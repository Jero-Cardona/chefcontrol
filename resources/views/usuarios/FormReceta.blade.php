
@extends('layouts.app')
@section('style')
{{-- en esta seccion irian los estilos necesarios para el archivo --}}
<link rel="stylesheet" href="{{ asset('/css/estilosProducto.css')}}">
@endsection
@section('content')
@auth
@if (session('success'))
     <div style="padding: 10px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; color: white; background-color: rgba(255, 102, 0); border-color: #f5c6cb;" role="alert">
        
        {{ session('success') }}
    </div>
@endif    

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
                <div class="formRegistro">
                    <input id="imagen" name="imagen" type="file"  >
                    <label for="imagen"></label>
                    @error('imagen')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="btn1Registro">
                    <input type="submit" class="enviarRegistro">
                </div>
            </form>
        </div>
    </div>
    @endauth
@endsection