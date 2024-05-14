@extends('layouts.app')
@section('title','ChefControl | Editar cliente')
{{ session('confirm-producto') }}
@section('content')
    <body>
        {{ session('confirm-user') }}
        <div class="contenedorFormRegistro">
            <div class="contenedorFormRegistro1">
                <div class="tituloRegistro">
                    <h2>Actualizar clientes</h2>
                </div>
                {{-- formulario de registro de usuarios resposive --}}
                <form action="{{ route('cliente.update', $cliente[0]->Id_Cliente) }}" method="POST"
                    class="formularioRegistro">
                    @csrf
                    @method('PUT')
                    <div class="formRegistro">
                        <input value="{{ $cliente[0]->Id_Cliente }}" id="Id_Cliente" name="Id_Cliente" type="text" required>
                        <label for="Id_Cliente">Número de documento</label>
                    </div>
                    <div class="form1Registro">
                        <select value="{{ $cliente[0]->Tipo_identificacion }}" id="Tipo_identificacion"
                            name="Tipo_identificacion" required>
                            <option value="" disabled selected hidden>{{ $cliente[0]->Tipo_identificacion }}</option>
                            <option value="Cédula de Ciudadanía">Cédula de Ciudadanía (CC)</option>
                            <option value="Tarjeta de Identidad">Tarjeta de Identidad (TI)</option>
                            <option value="Cédula de Extranjería ">Cédula de Extranjería (CE)</option>
                            <option value="NIT">NIT (Número de Identificación Tributaria)</option>
                            <option value="Pasaporte">Pasaporte</option>
                        </select>
                    </div>
                    <div class="formRegistro">
                        <input value="{{ $cliente[0]->Nombre }}" id="Nombre" name="Nombre" type="text">
                        <label for="Nombre"> Nombre Usuario</label>
                    </div>
                    <div class="formRegistro">
                        <input value="{{ $cliente[0]->Apellido }}" id="Apellido" name="Apellido" type="text" required>
                        <label for="Apellido"> Apellido Usuario</label>
                    </div>
                    <div class="formRegistro">
                        <input value="{{ $cliente[0]->Telefono }}" id="Telefono" name="Telefono" type="text" required>
                        <label for="Telefono"> Teléfono Usuario</label>
                    </div>
                    <div class="form1Registro">
                        <select value="{{ $cliente[0]->estado }}" id="estado" name="estado" required>
                            <option value="" disabled selected hidden>Tipo de Usuario {{ $cliente[0]->estado }}
                            </option>
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                        </select>
                    </div>
                    <div class="btn1Registro">
                        <input type="submit" value="Guardar Cambios" class="enviarRegistro">
                    </div>
                </form>
            </div>
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
