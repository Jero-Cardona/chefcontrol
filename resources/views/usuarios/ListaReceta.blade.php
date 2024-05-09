<body>
    <div class="fondo">
        <div>
            <form action="#">
                <input type="text" placeholder="Buscar receta">
                <button type="submit">Buscar</button>
            </form>
        </div>
        <div class="titulo">
            <h1>Lista de Recetas</h1>
        </div>
        <table id="recetas">
            <thead>
                <tr>
                    <th class="titulo-campo">Id</th>
                    <th class="titulo-campo">Nombre</th>
                    <th class="titulo-campo">Descripción</th>
                    <th class="titulo-campo">Costo Total</th>
                    <th class="titulo-campo">Contribución</th>
                    <th v>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Tortilla de patatas</td>
                    <td>Receta tradicional española con patatas, cebolla y huevos.</td>
                    <td>$5</td>
                    <td>Fácil</td>
                    <td><a href="#">Ver</a> | <a href="#">Editar | <a href="#">Aprobar | <a
                                    href="#">Eliminar</a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Ensalada de pasta</td>
                    <td>Refrescante ensalada con pasta, verduras y aderezo.</td>
                    <td>$3</td>
                    <td>Fácil</td>
                    <td><a href="#">Ver</a> | <a href="#">Editar | <a href="#">Aprobar | <a
                                    href="#">Eliminar</a></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Pollo al horno</td>
                    <td>Pollo marinado y horneado con verduras.</td>
                    <td>$10</td>
                    <td>Media</td>
                    <td><a href="#">Ver</a> | <a href="#">Editar | <a href="#">Aprobar | <a
                                    href="#">Eliminar</a></td>
                </tr>
            </tbody>
        </table>
        <br>
    </div>
    <h4>¿Desea crear una nueva receta</h4>
    <a href="EsReceta.php" class="btn btn-primary">Crear</a>
</body>
