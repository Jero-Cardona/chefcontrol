<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/estilosIndexInicio.css')}}" >
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap" rel="stylesheet">
    <title>ChefControl</title>
</head>
<body>
    <div class="contenedorIndex">
        <div class="div-index">
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
                    <a class="activeIndex" href="{{route('receta.recetario')}}">Inicio</a>
                    <a href="{{route('login')}}">Iniciar sesión</a>
                    <a href="{{route('usuarios.create')}}">Registrarse</a>
                </nav>
            </div>
        </header>
        </div>
        <div class="caja2">
            <img class="logo"src="{{asset('imagenes/proyecto/logo.svg')}}" alt="">
        </div>
        <div id="inicio" class="caja3">
            <div class=>
                <h2 class="tittle">Bienvenidos a nuestro sitio web</h2>
                <p>ChefControl es un aplicativo para el manejo y la estandarización de las recetas, para el SENA sede comercio del municipio de Rionegro Antioquia.</p>
            </div>
        </div>
        <div class="caja4">
            <div>
                <h2 class="tittle">SENA Rionegro</h2>
                <p>La cocina ha venido presentando problemas a la hora del papeleo a mano y por ello han decidido digitalizar todo, y por ello este aplicativo.</p>
            </div>
            <div>
                <img class="sena" src="{{asset('imagenes/proyecto/sena.jpg')}}" alt="">
            </div>
        </div>
        <div class="caja5">
            <div>
                <img class="recetas" src="{{asset('imagenes/proyecto/recetas.jpg')}}" alt="">
            </div>
            <div>
                <h2 class="tittle">Recetas</h2>
                <p>Apartado para la explicación de las recetas, junto con su paso a paso. Arrocito con huevo y crema de algas marinadas a la marge.</p>
            </div>
        </div>
        <footer class="footerIndex">
            <img class="logo1SenaIndex" src="{{asset('imagenes/proyecto/logoSena.png')}}">
            <p><b>Servicio nacional de aprendizaje <br>
                Centro de la Innovación, agroindustria y aviación</b></p>
            <img class="logo3Index" src="{{asset('imagenes/proyecto/logo.svg')}}">
        </footer>
    </div>
</body>
</html>
<!--Parte Laura-->

