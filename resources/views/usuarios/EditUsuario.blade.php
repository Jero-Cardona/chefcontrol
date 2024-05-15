@extends('layouts.app')
@section('title','ChefControl | Editar usuario')
{{ session('confirm-producto') }}
@section('content')
    <body>
        {{ session('confirm-user') }}
        <div class="contenedorFormRegistro">
            <div class="contenedorFormRegistro1">
                <div class="tituloRegistro">
                    <h2>Actualizar Usuarios</h2>
                </div>
                {{-- formulario de registro de usuarios resposive --}}
                <form action="{{ route('usuarios.update', $usuario[0]->Id_Empleado) }}" method="POST"
                    class="formularioRegistro">
                    @csrf
                    @method('PUT')
                    <div class="formRegistro">
                        <input value="{{ $usuario[0]->Id_Empleado }}" id="Id_Empleado" name="Id_Empleado" type="text"
                            required>
                        <label for="Id_Empleado">Número de documento</label>
                    </div>
                    <div class="form1Registro">
                        <select value="{{ $usuario[0]->tipo_documento }}" id="tipo_documento" name="tipo_documento"
                            required>
                            <option value="" disabled selected hidden>Tipo de documento</option>
                            <option value="Cédula de Ciudadanía">Cédula de Ciudadanía (CC)</option>
                            <option value="Tarjeta de Identidad">Tarjeta de Identidad (TI)</option>
                            <option value="Cédula de Extranjería ">Cédula de Extranjería (CE)</option>
                            <option value="NIT">NIT (Número de Identificación Tributaria)</option>
                            <option value="Pasaporte">Pasaporte</option>
                        </select>
                    </div>
                    <div class="formRegistro">
                        <input value="{{ $usuario[0]->Nombre }}" id="Nombre" name="Nombre" type="text" required>
                        <label for="Nombre"> Nombre Usuario</label>
                    </div>
                    <div class="formRegistro">
                        <input value="{{ $usuario[0]->Apellido }}" id="Apellido" name="Apellido" type="text" required>
                        <label for="Apellido"> Apellido Usuario</label>
                    </div>
                    <div class="formRegistro">
                        <input value="{{ $usuario[0]->Telefono }}" id="Telefono" name="Telefono" type="text" required>
                        <label for="Telefono"> Teléfono Usuario</label>
                    </div>
                    <div class="form1Registro">
                        <select value="{{ $usuario[0]->Id_Rol }}" id="Id_Rol" name="Id_Rol" required>
                            <option value="" disabled selected hidden>Tipo de usuario</option>
                            <option value="1">Usuario Cocinero</option>
                            <option value="2">Usuario Administrador</option>
                        </select>
                    </div>
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
        </div>
    </body>
@endsection
