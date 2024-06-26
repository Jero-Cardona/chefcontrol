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
<body>
    {{session ('confirm-user')}}
        <div class="contenedorFormRegistro">
            <div class="contenedorFormRegistro1">
                <div class="tituloRegistro">
                    <h2>Registrar Clientes</h2>
                </div>
                {{-- formulario de registro de usuarios resposive --}}
                <form action="{{route('cliente.store')}}" method="POST" class="formularioRegistro" id="form">
                    @csrf
                    <div class="formRegistro">
                        <input id="Id_Cliente" name="Id_Cliente" type="number" value="{{old('Id_Cliente')}}">
                        <label for="Id_Cliente">Numero de documento</label>
                         @error('Id_Cliente')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form1Registro">
                        <select id="Tipo_identificacion" name="Tipo_identificacion" value="{{old('Tipo_identificacion')}}">
                            <option value="" disabled selected hidden>Tipo de documento</option>
                            <option value="Cédula de Ciudadanía"  @if(old('Tipo_identificacion') == 'Cédula de Ciudadanía') selected @endif>Cédula de Ciudadanía (CC)</option>
                            <option value="Tarjeta de Identidad"  @if(old('Tipo_identificacion') == 'Tarjeta de Identidad') selected @endif>Tarjeta de Identidad (TI)</option>
                            <option value="Cédula de Extranjería "  @if(old('Tipo_identificacion') == 'Cédula de Extranjería ') selected @endif>Cédula de Extranjería (CE)</option>
                            <option value="NIT"  @if(old('Tipo_identificacion') == 'NIT') selected @endif>NIT (Número de Identificación Tributaria)</option>
                            <option value="Pasaporte"  @if(old('Tipo_identificacion') == 'Pasaporte') selected @endif>Pasaporte</option>
                        </select>
                        @error('Tipo_identificacion')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formRegistro">
                        <input id="Nombre" name="Nombre" type="text" value="{{old('Nombre')}}">
                        <label for="Nombre"> Nombre Cliente</label>
                        @error('Nombre')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formRegistro">
                        <input id="Apellido" name="Apellido" type="text" value="{{old('Apellido')}}">
                        <label for="Apellido"> Apellido Cliente</label>
                        @error('Apellido')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formRegistro">
                        <input id="Telefono" name="Telefono" type="text" value="{{old('Telefono')}}">
                        <label for="Telefono"> Telefono Cliente</label>
                        @error('Telefono')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                  
                    <div class="form1Registro">
                        <input type="hidden" value="1" name="estado">
                        {{-- <select id="estado" name="estado" value="{{old('estado')}}">
                            <option value="" disabled selected hidden>Tipo de Usuario</option>
                            <option value="1"  @if(old('estado') == '1') selected @endif>Activo</option>
                            <option value="2"  @if(old('estado') == '2') selected @endif>Inactivo</option>
                        </select>
                        @error('estado')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror --}}
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
    {{-- </div> --}}
</body>
@endauth
@endsection