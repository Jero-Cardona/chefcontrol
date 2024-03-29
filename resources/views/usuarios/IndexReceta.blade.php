
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{asset('/css/estilosReceta.css')}}" >
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap" rel="stylesheet">
        <title>Recetario</title>
</head>
<body>
    <div class="contenedorRecetas">
        <header class="headerRecetas">
            <div class="contenedorHR">
                <div>
                    <img class="logo1Recetas" src="{{asset('imagenes/proyecto/logo.svg')}}">
                </div>
                <div class="usuarioRecetas">
                    <h2>Usuario</h2>
                    <h4>Rol</h4>
                </div>
                <div class="btnMenuR">
                    <label for="btnMenu">Menú</label>
                </div>
                <input type="checkbox" id="btnMenu">
                <nav class="menuRecetas">
                    <a href="#">Recetas</a>
                    <a href="#">Sugerir</a>
                    <a href="#">Listado de recetas</a>
                </nav>
            </div>
        </header>
        <div class="contenedor1Recetas">
            <img class="fondo1Recetas" src="{{asset('imagenes/proyecto/image33.png')}}">
            <div class="caja1Recetas">
                <img class="logo2Recetas" src="{{asset('imagenes/proyecto/logo.svg')}}">
                <h2 class="textRecetas1">Bienvenidos a nuestro sitio web</h2>
                <p class="textRecetas2">El recetario es un libro que contiene recetas culinarias. La receta se
                    caracteriza por indicar los elementos que entran en la composición y <br>
                    elaboración de un plato de cocina y la manera en que se prepara.</p>
            </div>
        </div>
        <div class="contenedor2Recetas">
                <a class="a1Recetas" href="#">
                    <img src="{{asset('imagenes/proyecto/image21.png')}}">
                    <b>Estandarizar</b>
                </a>
                <a class="a2Recetas" href="#">
                    <img src="{{asset('imagenes/proyecto/image4.png')}}">
                    <b>Sugerir</b>
                </a>
                <a class="a3Recetas" href="#">
                    <img src="{{asset('imagenes/proyecto/image22.png')}}">
                    <b>Recetario</b>
                </a>
                <p><b>Las siguientes opciones permiten distintas funcionalidades de acuerdo a el perfil de usuario y el uso que este mismo desde, las <br>
                    opciones son: Estandarizar, Sugerir, Ver listado (Editar, Borrar),etc...</b></p>
        </div>
        <div class="contenedorRecetario">
            <h2 class="tituloRecetario">Recetario</h2>
            <div class="recetario1">



                
                    <div class="hover1Recetas">
                        @foreach ($recetas as $receta)
                        <figure>
                            <a href="{{ route('receta.tomas')}}">
                                    <h2>{{ $receta->Nombre }}</h2>
                                    <p>{{ $receta->Descripcion }}</p>
                                    <img src="{{ $receta->imagen }}" alt="{{ $receta->Nombre }}">
                            </a>
                        </figure>
                        @endforeach
                    </div>  
            </div>
        </div>
        <footer class="footerRecetas">
            <img class="logo1SenaRecetas" src="{{asset('imagenes/proyecto/logoSena.png')}}">
            <p><b>Servicio nacional de aprendizaje <br>
                Centro de la Innovacion, agroindustria y aviacion</b></p>
            <img class="logo3Recetas" src="{{asset('imagenes/proyecto/logo.svg')}}">
        </footer>
    </div>
</body>
</html>

