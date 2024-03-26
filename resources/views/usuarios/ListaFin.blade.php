
@extends('layouts.app')
    @section('style')
        <link rel="stylesheet" href="{{asset('/css/estilosListasChequeo.css')}}">
    @endsection
    @section('content')
<body>
{{-- <div class="container-check">
    <div class="dashboard"> 
        <ul>
        <div class="buttons">
            <div class="button1">
                <a href="#"><h1>Recetas</h1></a>
            </div>
            <div class="button2">
                <a href="#"><h1>Sugerencias</h1></a>
            </div>
            <div class="button3">
                <a href="#"><h1>Autorización</h1></a>
            </div>
            <div class="button4">
                <a href="#"><h1>Formatos</h1></a>
            </div>
            <div class="button5">
                <a href="#"><h1>Asignación</h1></a>
            </div>
            <div class="button6">
               <a href="#"><h1>Configuración</h1></a>
            </div>
        </div>
        </ul>
    </div> --}}

    <div class="formulario">
        <div class="tittle">
            <h2>Lista Fin jornada</h2>
        </div><br>
        <div class="content">
            <form id="form-verificacion" action="" method="post">
                <label class="tittle-items">Selecciona los elementos:</label><br><br>
                <label class="items-tareas">
                <input type="checkbox" name="items[]" value="Tarea 1">Mesones desinfectados (aspersión).<br>
                <input type="checkbox" name="items[]" value="Tarea 2">Trampas limpias.<br>
                <input type="checkbox" name="items[]" value="Tarea 3">Verificar que las fichas entreguen cocina en óptimas condiciones.<br>
                <input type="checkbox" name="items[]" value="Tarea 4">Verificar y rotular productos.<br>
                <input type="checkbox" name="items[]" value="Tarea 6">No deben quedar elementos de aseo en la cocina al finalizar la jornada.<br>
                <input type="checkbox" name="items[]" value="Tarea 7">Verificar estado de equipos de refrigeración (en caso de anomalías trasladar los insumos).<br>
                <input type="checkbox" name="items[]" value="Tarea 8">Verificar que los lavados queden totalmente limpios, sin restos de comidas.<br>
                <input type="checkbox" name="items[]" value="Tarea 9">Verificar que las llaves del gas estén cerradas<br>
                <input type="checkbox" name="items[]" value="Tarea 10">Verificar que no quede comida en hornos, ni descubierta.<br>
                <input type="checkbox" name="items[]" value="Tarea 1">Realizar la correcta descongelación de productos que así se requieran.<br>
                <input type="checkbox" name="items[]" value="Tarea 2">Canecas de basura deben quedar totalmente limpias y sin residuos de comida.<br>
                <input type="checkbox" name="items[]" value="Tarea 3">Verificar que mesones de zona de lavado queden totalmente limpios y sin residuos de comida.<br>
                <input type="checkbox" name="items[]" value="Tarea 4">Desconectar y verificar limpieza de horno microondas, bascula, batidoras y amasadoras.<br>
                <input type="checkbox" name="items[]" value="Tarea 6">Apagar todas las luces.<br>
                <input type="checkbox" name="items[]" value="Tarea 7">No mover equipos sin consultar con el instructor.<br>
                <input type="checkbox" name="items[]" value="Tarea 8">Informar a tiempo todas las anomalías, con evidencia fotográfica.<br>
                <input type="checkbox" name="items[]" value="Tarea 9">Informar al instructor de turno que se retire de la cocina, en caso de que pueda requerir algún proceso adicional.<br>
                <input type="checkbox" name="items[]" value="Tarea 10">Si al momento de retirarse se encuentra un instructor en cocina repórtele que se retire, para saber si el necesita su apoyo.<br>
                </label><br>
                <input class="btn-submit" type="submit" value="Enviar">
            </form>
        </div>
    </div>
</body>
@endsection