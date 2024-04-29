<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\TblFormatosController;
use App\Http\Controllers\TblClienteController;
use App\Http\Controllers\TblDetallerecetaController;
use App\Http\Controllers\TblProductoController;
use App\Http\Controllers\TblRecetaController;
use App\Http\Controllers\TblTareascompletadasController;
use App\Http\Controllers\TblTareasController;
use App\Http\Controllers\TblTipoproductoController;
use App\Http\Controllers\TblUsuariosController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\TblOrdenproduccionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Ruta del Index Principal
Route::view("/",'home')->name('home');
// Rutas de Usuario
Route::get('/login',[TblUsuariosController::class,'login'])->name('login');
Route::post('/LoginStore', [TblUsuariosController::class, 'storeLogin'])->name('login.store');
Route::get('logout', [TblUsuariosController::class, 'logout'])->name('logout');

// Rutas del Crud
Route::get("/CrudClientes",[TblClienteController::class, 'index'])->name('crudclientes');
Route::get("/CrudRecetas", [TblRecetaController::class, 'index'])->name('crudrecetas');
Route::get("/CrudRecetasInactivas", [TblRecetaController::class, 'indexInactivas'])->name('crudrecetas.inactivas');
Route::get("/CrudProductos",[TblProductoController::class, 'index'])->name('crudproductos');
Route::get("/CrudRecetasEnEspera", [TblRecetaController::class, 'indexEspera'])->name('crudrecetas.espera');
Route::get('/recetas/{Id_Receta}/Estandarizar', [TblRecetaController::class, 'estandarizar'])->name('receta.estandarizar');


// Route::view("/listaUsuarios","usuarios.CrudUsuario")->name("usuarios.crud");
Route::get('/usuarios', [TblUsuariosController::class, 'index'])->name('usuarios.index');
Route::get('/crear', [TblUsuariosController::class, 'create'])->name('usuarios.create');
Route::get('/crearUsuarioAdmin', [TblUsuariosController::class, 'createAdmin'])->name('Admin.create');
Route::post('/registro', [TblUsuariosController::class, 'store'])->name('usuarios.store');
Route::get('/Usuario/{Id_Empleado}/edit', [TblUsuariosController::class, 'edit'])->name('usuarios.edit');
Route::put('/Usuario/{Id_Empleado}', [TblUsuariosController::class, 'update'])->name('usuarios.update');
Route::delete('/Usuario/{Id_Empleado}', [TblUsuariosController::class, 'destroy'])->name('usuarios.destroy');
// activar y desactivar cliente
Route::get('/Usuario/{Id_Empleado}/inactive', [TblUsuariosController::class, 'inactive'])->name('usuario.inactive');
Route::get('/Usuario/{Id_Empleado}/active', [TblUsuariosController::class, 'active'])->name('usuario.active');
// descarga usuarios pdf
Route::get('Usuariospdf',[TblUsuariosController::class, 'pdf'])->name('usuarios.pdf');
// buscar registros de usuarios
Route::get('/buscarUsuarios', [TblUsuariosController::class, 'buscar'])->name('buscar.usuarios');



// Rutas del modulo Recetas
Route::view("/Recetas", 'usuarios.IndexReceta')->name('recetas.index');


//parte para traer las recetas y mostrarla una por una junto con sus ingredientes y carcularlos
Route::get('/Recetario',[TblRecetaController::class, 'recetario'])->name('receta.recetario');
Route::get('/Receta-Ingredientes/{Id_Receta}', [TblRecetaController::class, 'showingrediente'])->name('receta.ingrediente');
Route::post('/Receta-Ingredientes/{Id_Receta}/Calcular-Porciones', [TblRecetaController::class, 'cantidadmultiplicada'])->name('recetas.cantidadmultiplicada');

//Rutas de las Ordenes de produccion 
Route::get('/Orden-Produccion', [TblOrdenproduccionController::class, 'create'])->name('orden.produccion');
// Route::view('/Orden-Produccion','usuarios.OrdenProduccion')->name('orden.produccion');
Route::post('/crearOrden', [TblOrdenproduccionController::class, 'store'])->name('orden.store');
Route::get('/Ordenes-De-Produccion',[TblOrdenproduccionController::class, 'index'])->name('orden.index');
Route::post('/ordenes/{orden}/detalles', [TblOrdenproduccionController::class,'storeDetalles'])->name('ordenes.detalles.store');
Route::post('/ordenes/detalles/bulk', [TblOrdenproduccionController::class,'storeBulkDetalles'])->name('ordenes.detalles.bulk');
Route::view('/Receta','usuarios.Receta');
Route::get('/ordenes/{orden}/detalles/edit',[TblOrdenproduccionController::class, 'editDetalles'])->name('ordenes.detalles.edit');
Route::put('/ordenes/{orden}/detalles',[TblOrdenproduccionController::class,'updateDetalles'])->name('ordenes.detalles.update');
Route::post('/orden/{ordenId}/preparacion-iniciar', [TblOrdenproduccionController::class  ,'iniciarPreparacion'])->name('orden.preparacion.iniciar');
Route::post('/orden/{ordenId}/entregado', [TblOrdenproduccionController::class,'marcarComoEntregado'])->name('orden.entregado');
Route::get('/ordenes/espera', [TblOrdenproduccionController::class,'indexOrdenesEspera'])->name('ordenes.espera');
Route::get('/ordenes/preparacion', [TblOrdenProduccionController::class ,'indexOrdenesPreparacion'])->name('ordenes.preparacion');
Route::get('/ordenes/entregadas', [TblOrdenProduccionController::class ,'indexOrdenesEntegadas'])->name('ordenes.entregadas');
// buscar ordenes 
Route::get('/buscarOrdenesEnEspera', [TblOrdenproduccionController::class, 'buscarEspera'])->name('buscar.ordenesEspera');
Route::get('/buscarOrdenesEnPreparacion', [TblOrdenproduccionController::class, 'buscarPreparacion'])->name('buscar.ordenesPreparacion');
Route::get('/buscarOrdenesEntregadas', [TblOrdenproduccionController::class, 'buscarEntregadas'])->name('buscar.ordenesEntregadas');






//Rutas recetas
Route::get("/FormularioReceta", [TblRecetaController::class, 'create'])->name('receta.create');
Route::post("/FormularioR",[TblRecetaController::class, 'store'])->name("receta.store");
Route::get('/Receta/{Id_Receta}/Editar', [TblRecetaController::class, 'edit'])->name('receta.edit');
Route::put('/Receta/{Id_Receta}', [TblRecetaController::class, 'update'])->name('receta.update');
Route::delete('/Receta/{Id_Receta}', [TblRecetaController::class, 'destroy'])->name('receta.destroy');
//recetas sugeridas index
Route::get('/recetassugeridas', [TblRecetaController::class, 'indexSugeridas'])->name('recetas.sugeridas');
//Inactivas y activar recetas
Route::get('/recetas/{Id_Receta}/inactive', [TblRecetaController::class, 'inactive'])->name('receta.inactive');
Route::get('/recetas/{Id_Receta}/activereceta', [TblRecetaController::class, 'active'])->name('receta.active');
// buscar registros
Route::get('/buscarReceta', [TblRecetaController::class, 'buscar'])->name('buscar.recetas');
// descargar registros de recetas
Route::get('Recetaspdf',[TblRecetaController::class, 'pdf'])->name('recetas.pdf');

// Rutas de detalle receta
Route::get("/FDetalleReceta", [TblDetallerecetaController::class, 'create'])->name('detalleReceta.create');
Route::post("/FormularioDR",[TblDetallerecetaController::class, 'store'])->name("detalleReceta.store");

// Rutas de producto
Route::get('FormularioProductos', [TblProductoController::class, 'create'])->name('producto.create');
Route::post('Producto', [TblProductoController::class, 'store'])->name('producto.store');
Route::get('/Producto/{Cod_Producto}/Editar', [TblProductoController::class, 'edit'])->name('producto.edit');
Route::put('/Producto/{Cod_Producto}', [TblProductoController::class, 'update'])->name('producto.update');
Route::delete('/Producto/{Cod_Producto}', [TblProductoController::class, 'destroy'])->name('producto.destroy');
// Activar e Inactivar Productos
Route::get('/Producto/{Cod_Producto}/inactive', [TblProductoController::class, 'inactive'])->name('producto.inactive');
Route::get('/Producto/{Cod_Producto}/active', [TblProductoController::class, 'active'])->name('producto.active');
// Buscar registro de productos
Route::get('/buscarProducto', [TblProductoController::class, 'buscar'])->name('buscar.productos');
// descargar pdf de registros de producto
Route::get('/Producto.pdf', [TblProductoController::class, 'pdf'])->name('producto.pdf');





// Rutas de Cliente
Route::get('/RegistrarCliente', [TblClienteController::class, 'create'])->name('clienteCrear');
Route::post('/Clientes', [TblClienteController::class, 'store'])->name('cliente.store');
Route::get('/Cliente/{Id_Cliente}/editar', [TblClienteController::class, 'edit'])->name('cliente.edit');
Route::put('/Cliente/{Id_Cliente}', [TblClienteController::class, 'update'])->name('cliente.update');
// activar y desactivar cliente
Route::get('/Cliente/{Id_Cliente}/inactive', [TblClienteController::class, 'inactive'])->name('cliente.inactive');
Route::get('/Cliente/{Id_Cliente}/active', [TblClienteController::class, 'active'])->name('cliente.active');
// buscar registros de clientes
Route::get('/buscarCliente', [TblClienteController::class, 'buscar'])->name('buscar.clientes');
// descargar pdf de registros de cliente
Route::get('Clientespdf', [TblClienteController::class, 'pdf'])->name('clientes.pdf');

//Rutas Listas de Chequeo-Edilberto
Route::get('/ListaInicio',[TblTareasController::class,'Inicio'])->name(('lista.inicio'));
Route::post('/enviar-tareas', [TblTareascompletadasController::class, 'store'])->name('listainicio.store');
Route::get("/CrudListaInicio",[TblTareascompletadasController::class, 'indexInicio'])->name('crud.listainicio');
Route::get("/CrudListaFin",[TblTareascompletadasController::class, 'indexFin'])->name('crud.listafin');
Route::get('VerTareas/Inicio/{fecha}', [TblTareascompletadasController::class, 'verTareasInicio'])->name('tareasInicio');
Route::get('VerTareas/Fin/{fecha}', [TblTareascompletadasController::class, 'verTareasFin'])->name('tareasFin');


Route::get('/ListaFin',[TblTareasController::class,'Fin'])->name(('lista.fin'));
Route::post('/EnviodeTareas',[TblTareascompletadasController::class, 'store'])->name('listafin.store');


