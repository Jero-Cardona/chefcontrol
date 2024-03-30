@extends('layouts.app')
@section('content')
{{-- <h1>Nombre : 'Nombre de receta'</h1>
<h1>Descripcion :</h1>
<p>'Descripcion de la receta por ende esto es supuestamente un texto largo supuestamente  entonces para que parezca largo pondre blah blah blah blah blah blahblah blah blahblah blah blahblah blah blahblah blah blahblah blah blahblah blah blahblah blah blahblah blah blahblah blah blahblah blah blahblah blah blahblah blah blahblah blah blahblah blah blahblah blah blahblah blah blahblah blah blahblah blah blahblah blah blahblah blah blahblah blah blahblah blah blah'</p>
<div>
    <p>Ingresar candidad de personas</p>
    <div><input type="text" id="texto"></div>
    <button onclick="mostrarTexto()">Ingresar</button>
    <h2>Ingredientes</h2>
    <p>Para <p id="textoMostrado"><p> personas</p>
    <script>
        function mostrarTexto() {
            var texto = document.getElementById("texto").value;
            document.getElementById("textoMostrado").innerText = texto;
        }
    </script>
    <ol>
        <li>Ingrediente 1</li>
        <li>Ingrediente 2</li>
        <li>Ingrediente 3</li>
    </ol>
</div> --}}



<div>
    <h2>{{ $receta->receta_nombre }}</h2>
    <p>{{ $receta->Descripcion }}</p>
    <img src="{{ $receta->receta_imagen }}" alt="{{ $receta->receta_nombre }}">

    <h3>Ingredientes</h3>
    <ul>
        <li>
            {{ $receta->producto_nombre }}
            ({{ $receta->Cantidad }} {{ $receta->unidad_medida }})
        </li>
    </ul>
    <br>
    {{-- <legend>
        <fieldset>
            
            <form action="{{ route('recetas.calcular', ['Id_Receta' => $idReceta]) }}" method="POST">
            @csrf
                <label for="porciones">Número de porciones:</label>
                <input type="number" id="porciones" name="porciones" min="1" required>
                <button type="submit">Calcular</button>
            </form>
        </fieldset>
    </legend> --}}
</div

@endsection
