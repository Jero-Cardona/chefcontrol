@extends('layouts.app')
@section('content')
<h1>Nombre : 'Nombre de receta'</h1>
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
</div>

@endsection
