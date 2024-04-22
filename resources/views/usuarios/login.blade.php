<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/estilosLogin.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-0kI1HjxgLveGKz6cuwDSMN4wr1jUnslm2L1qLYF5bDOcVvU7kU0/73RbVhqGpjU/" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="contenedorLogin">
        <header class="headerIndex">
            <div class="contenedorHIndex">
                <div>
                    <img class="logoHIndex" src="{{asset('imagenes/proyecto/logo.svg')}}">
                </div>
                <div class="NombreProyectoLogin">
                    <h2>ChefControl</h2>
                </div>
                <div class="btnMenuHIndex">
                    <label for="btnMenu">Menú</label>
                </div>
                <input type="checkbox" id="btnMenu">
                <nav class="menuHIndex">
                    <a href="{{route('home')}}">Inicio</a>
                    <a href="{{route('login')}}">Iniciar sesión</a>
                    <a href="{{route('usuarios.create')}}">Registrarse</a>
                </nav>
            </div>
        </header>
        @if (session('logout'))
        <div style="padding: 10px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; color: white; background-color: rgba(255, 102, 0); border-color: #f5c6cb;" role="alert">
        
            {{ session('logout') }}
        </div>
        @endif
        <div class="contenedorFormLogin">
        @if ($errors->any())
        <div style="padding: 10px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; color: white; background-color: rgba(255, 102, 0); border-color: #f5c6cb;" role="alert">
        @if ($errors->has('credentials'))
            {{ $errors->first('credentials') }}
        @else
            <p>Por favor, complete todos los campos.</p>
        @endif
        </div>
        @endif
            <div class="contenedor1Login">
                <div class="tituloFormLogin">
                    <h2>Iniciar sesión</h2>
                </div>
                 
                <form class="formularioLogin" method="POST" action="{{route('login.store')}}">
                    @csrf
                    <div class="form1Login">
                        <select id="tipo_documento" name="tipo_documento" >
                            <option value="" disabled selected hidden>Tipo de documento</option>
                            <option value="Cédula de Ciudadanía">Cédula de Ciudadanía (CC)</option>
                            <option value="Tarjeta de Identidad">Tarjeta de Identidad (TI)</option>
                            <option value="Cédula de Extranjería ">Cédula de Extranjería (CE)</option>
                            <option value="NIT">NIT (Número de Identificación Tributaria)</option>
                            <option value="Pasaporte">Pasaporte</option>
                        </select>
                    </div>
                    <div class="form2Login">
                        <input autofocus type="number" name="Id_Empleado" id="Id_Empleado" required>
                        <label for="Id_Empleado">Numero de documento</label>
                    </div>
                    <div class="form2Login">
                        <input type="password" name="password" id="password" required>
                        <label for="password">Contraseña</label>
                        {{-- <span class="toggle-password" onclick="togglePasswordVisibility()">
                            <i class="fas fa-eye"></i>
                            ver contraseña
                          </span> --}}
                        {{-- <button onclick="ShowPassword()">Mostrar contraseña</button> --}}
                    </div>
                    <div style="margin: 0 auto;">
                        <input type="checkbox" name="remember" >
                        <span>Recuerdame</span>
                    </div>
                    <div class="btn1Login">
                        <input type="submit" class="enviarLogin">
                        <a href="{{route('home')}}">Volver</a>
                    </div>
                    {{-- ver contraseña funcion --}}
                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                        <i class="fas fa-eye"></i>
                        ver contraseña
                      </span>
                </form>
                <img id="imagenlogin" src="{{asset('imagenes/proyecto/cocineros.png')}}">
            </div>
        </div>
        <footer class="footerLogin">
            <img class="logo1SenaLogin" src="{{asset('imagenes/proyecto/logoSena.png')}}">
            <p><b>Servicio nacional de aprendizaje <br>
                Centro de la Innovacion, agroindustria y aviacion</b></p>
            <img class="logo3Login" src="{{asset('imagenes/proyecto/logo.svg')}}">
        </footer>
    </div>
    <script src="{{asset('js/SweetAlerts.js')}}"></script>
</body>
</html>