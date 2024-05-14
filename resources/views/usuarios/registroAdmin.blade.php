@extends('layouts.app')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('confirm-user') }}
        </div>
    @endif
    <div class="contenedorRegistro">
        <div class="contenedorFormRegistro">
            <div class="contenedorFormRegistro1">
                <div class="tituloRegistro">
                    <h2>Registro Usuarios</h2>
                </div>
                {{-- formulario de registro de usuarios resposive --}}
                <form action="{{ route('usuarios.store') }}" method="POST" id="form" class="formularioRegistro">
                    @csrf
                    <div class="formRegistro">
                        <input type="text" id="Id_Empleado" name="Id_Empleado" value="{{ old('Id_Empleado') }}"
                            required>
                        <label for="Id_Empleado">Numero de documento</label>
                        @error('Id_Empleado')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form1Registro">
                        <select id="tipo_documento" name="tipo_documento" value="{{ old('tipo_documento') }}" required>
                            <option value="" disabled selected hidden>Tipo de documento</option>
                            <option value="Cédula de Ciudadanía" @if (old('tipo_documento') == 'Cédula de Ciudadanía') selected @endif>
                                Cédula de Ciudadanía (CC)</option>
                            <option value="Tarjeta de Identidad" @if (old('tipo_documento') == 'Tarjeta de Identidad') selected @endif>
                                Tarjeta de Identidad (TI)</option>
                            <option value="Cédula de Extranjería " @if (old('tipo_documento') == 'dula de Extranjería') selected @endif>
                                Cédula de Extranjería (CE)</option>
                            <option value="NIT" @if (old('tipo_documento') == 'NIT') selected @endif>NIT (Número de
                                Identificación Tributaria)</option>
                            <option value="Pasaporte">Pasaporte</option>
                        </select>
                        @error('tipo_documento')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formRegistro">
                        <input id="Nombre" name="Nombre" type="text" value="{{ old('Nombre') }}" required>
                        <label for="Nombre"> Nombre Usuario</label>
                        @error('Nombre')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formRegistro">
                        <input id="Apellido" name="Apellido" type="text" value="{{ old('Apellido') }}" required>
                        <label for="Apellido"> Apellido Usuario</label>
                        @error('Apellido')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formRegistro">
                        <input id="Telefono" name="Telefono" type="text" value="{{ old('Telefono') }}" required>
                        <label for="Telefono"> Teléfono Usuario</label>
                        @error('Telefono')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formRegistro">
                        <input id="password" name="password" type="password" value="{{ old('password') }}" required>
                        <label for="password">Contraseña</label>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formRegistro">
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            value="{{ old('password_confirmation') }}" required>
                        <label for="password_confirmation">Confimación de contraseña</label>
                        @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form1Registro">
                        <select id="Id_Rol" name="Id_Rol" value="{{ old('Id_Rol') }}" required>
                            <option value="" disabled selected hidden>Tipo de Usuario</option>
                            <option value="1" @if (old('tipo_documento') == '1') selected @endif>Administrador
                            </option>
                            <option value="2" @if (old('tipo_documento') == '2') selected @endif>Cocinero</option>
                        </select>
                        @error('Id_Rol')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        {{-- <input type="hidden" name="Id_Rol" id="Id_Rol" value="2"> --}}
                        <input type="hidden" name="estado" id="estado" value="1">
                    </div>
                    <div class="btn1Registro">
                        <input type="submit" class="enviarRegistro">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/SweetAlerts.js') }}"></script>
@endsection