<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/estilosLogin.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="contenedorLogin">
        <header class="headerIndex">
            <div class="contenedorHIndex">
                <div>
                    <img class="logoHIndex" src="../img/logo.svg">
                </div>
                <div class="NombreProyectoLogin">
                    <h2>ChefControl</h2>
                </div>
                <div class="btnMenuHIndex">
                    <label for="btnMenu">Menú</label>
                </div>
                <input type="checkbox" id="btnMenu">
                <nav class="menuHIndex">
                    <a href="#">Index</a>
                    <a href="#">Registrarse</a>
                </nav>
            </div>
        </header>
        <div class="contenedorFormLogin">
            <div class="contenedor1Login">
                <div class="tituloFormLogin">
                    <h2>Iniciar sesión</h2>
                </div>
                <form class="formularioLogin">
                    <div class="form1Login">
                        <select required>
                            <option value="" disabled selected hidden>Tipo de documento</option>
                            <option value="0">Cedula de ciudadania</option>
                            <option value="1">Cedula de extranjeria</option>
                            <option value="2">Tarjeta de identidad</option>
                        </select>
                    </div>
                    <div class="form2Login">
                        <input type="number" required>
                        <label>Numero de documento</label>
                    </div>
                    <div class="form2Login">
                        <input type="password" required>
                        <label>Contraseña</label>
                    </div>
                    <div class="btn1Login">
                        <input type="submit" class="enviarLogin">
                        <a href="../vistas/recetas.html">Volver</a>
                    </div>
                </form>
                <img src="../img/comida.webp">
            </div>
        </div>
    </div>
    <footer class="footerLogin">
        <img class="logo1SenaLogin" src="../img/logoSena.png">
        <p><b>Servicio nacional de aprendizaje <br>
            Centro de la Innovacion, agroindustria y aviacion</b></p>
        <img class="logo3Login" src="../img/logo.svg">
    </footer>
</body>
</html>