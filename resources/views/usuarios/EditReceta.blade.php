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
                </nav>
            </div>
        </header>
        <div class="contenedorFormRegistro">
            <div class="contenedorFormRegistro1">
                <div class="tituloRegistro">
                    <h2>Actualizar Receta</h2>
                </div>
                {{-- formulario de recetas resposive --}}
                <form action="{{route('receta.update', $receta[0]->Id_Receta)}}" enctype="multipart/form-data" method="POST" class="formularioRegistro">
                    @csrf
                    @method('PUT')
                    <div class="formRegistro">
                        <input value="{{$receta[0]->Nombre }}" id="Nombre" name="Nombre" type="text" required>
                        <label for="Nombre"> Nombre Receta</label>
                    </div>
                    <div class="formRegistro">
                        <input value="{{$receta[0]->Descripcion }}" id="Descripcion" name="Descripcion" type="text" required>
                        <label for="Descripcion"> Descripcion Receta</label>
                    </div>
                    <div class="formRegistro">
                        <input value="{{$receta[0]->Costo_Total }}" id="Costo_Total" name="Costo_Total" type="text" required>
                        <label for="Costo_Total"> Costo Total de la Receta</label>
                    </div>
                    <div class="formRegistro">
                        <input value="{{$receta[0]->Contribucion }}" id="Contribucion" name="Contribucion" type="number" required>
                        <label for="Contribucion">Contribucion</label>
                    </div>
                    <div class="form1Registro">
                        <select value="{{$receta[0]->Estado}} "id="Estado" name="Estado" required>
                            <option value="" disabled selected hidden>Estado de la Receta {{$receta[0]->Estado}}</option>
                            <option value="1">Estandarizada (1)</option>
                            <option value="2">En Espera (2)</option>
                        </select>
                    </div>
                    <div class="formRegistro">
                        {{-- <img style="width: 200px" src="{{asset($receta[0]->imagen)}}" alt="imagen"> --}}
                        <input value="{{$receta[0]->imagen }}" id="imagen1" name="imagen1" type="file" required>
                        <label for="imagen1"></label>
                    </div>
                   
                    <div class="btn1Registro">
                        <input type="submit" value="Guardar Cambios" class="enviarRegistro">
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