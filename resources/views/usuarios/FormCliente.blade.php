<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('/css/estilosRegister.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap" rel="stylesheet">
    <title>Registro</title>
</head>
<body>
    {{session ('confirm-user')}}
    <div class="contenedorRegistro">
        <header class="headerIndex">
            <div class="contenedorHIndex">
                <div>
                    <img class="logoHIndex" src="{{asset('imagenes/proyecto/logo.svg')}}">
                </div>
                <div class="NombreProyectoIndex">
                    <h2>ChefControl</h2>
                </div>
                <div class="btnMenuHIndex">
                    <label for="btnMenu">Menú</label>
                </div>
                <input type="checkbox" id="btnMenu">
                <nav class="menuHIndex">
                    <a href="{{route('usuarios.index')}}">Inicio</a>
                    <a href="../vistas/login.html">Iniciar sesión</a>
                    <a class="activeIndex" href="../vistas/register.html">Registrarse</a>
                </nav>
            </div>
        </header>
        <div class="contenedorFormRegistro">
            <div class="contenedorFormRegistro1">
                <div class="tituloRegistro">
                    <h2>Registrar Clientes</h2>
                </div>
                {{-- formulario de registro de usuarios resposive --}}
                <form action="{{route('cliente.store')}}" method="POST" class="formularioRegistro">
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
                        <label for="Nombre"> Nombre Usuario</label>
                        @error('Nombre')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formRegistro">
                        <input id="Apellido" name="Apellido" type="text" value="{{old('Apellido')}}">
                        <label for="Apellido"> Apellido Usuario</label>
                        @error('Apellido')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formRegistro">
                        <input id="Telefono" name="Telefono" type="text" value="{{old('Telefono')}}">
                        <label for="Telefono"> Telefono Usuario</label>
                        @error('Telefono')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form1Registro">
                        <select id="estado" name="estado" value="{{old('estado')}}">
                            <option value="" disabled selected hidden>Tipo de Usuario</option>
                            <option value="1"  @if(old('estado') == '1') selected @endif>Activo</option>
                            <option value="2"  @if(old('estado') == '2') selected @endif>Inactivo</option>
                        </select>
                        @error('estado')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
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
    </div>
</body>
</html>