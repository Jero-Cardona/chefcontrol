<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/estilosLayout.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap"
        rel="stylesheet">
    <title>Registro</title>
</head>

<body>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('confirm-user') }}
        </div>
    @endif
    <div class="contenedorRegistro">
        <header class="headerIndex">
            <div class="contenedorHIndex">
                <div>
                    <img class="logoHIndex" src="{{ asset('imagenes/proyecto/logo.svg') }}">
                </div>
                <div class="NombreProyectoIndex">
                    <h2>ChefControl</h2>
                </div>
                <div class="btnMenuHIndex">
                    <label for="btnMenu">Menú</label>
                </div>
                <input type="checkbox" id="btnMenu">
                <nav class="menuHIndex">
                    <a href="{{ route('home') }}">Inicio</a>
                    <a href="{{ route('login') }}">Iniciar sesión</a>
                    <a href="{{ route('usuarios.create') }}">Registrarse</a>
                </nav>
            </div>
        </header>
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
                        <label for="Telefono"> Telefono Usuario</label>
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
                        {{-- <select id="Id_Rol" name="Id_Rol" value="{{old('Id_Rol')}}" required>
                            <option value="" disabled selected hidden>Tipo de Usuario</option>
                            <option value="1" @if (old('tipo_documento') == '1') selected @endif>Administrador</option>
                            <option value="2" @if (old('tipo_documento') == '2') selected @endif>Cocinero</option>
                        </select>
                         @error('Id_Rol')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror --}}
                        <input type="hidden" name="Id_Rol" id="Id_Rol" value="2">
                        <input type="hidden" name="estado" id="estado" value="0">
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
    <!-- enlace de la libreria de SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- enalce a scripts personalizados del aplicativo --}}
    <script src="{{ asset('js/SweetAlerts.js') }}"></script>
</body>

</html>
