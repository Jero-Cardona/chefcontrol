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
Route::get("/CrudProductos",[TblProductoController::class, 'index'])->name('crudproductos');

// Route::view("/listaUsuarios","usuarios.CrudUsuario")->name("usuarios.crud");
Route::get('/usuarios', [TblUsuariosController::class, 'index'])->name('usuarios.index');
Route::get('/crear', [TblUsuariosController::class, 'create'])->name('usuarios.create');
Route::post('/registro', [TblUsuariosController::class, 'store'])->name('usuarios.store');
Route::get('/Usuario/{Id_Empleado}/edit', [TblUsuariosController::class, 'edit'])->name('usuarios.edit');
Route::put('/Usuario/{Id_Empleado}', [TblUsuariosController::class, 'update'])->name('usuarios.update');
Route::delete('/Usuario/{Id_Empleado}', [TblUsuariosController::class, 'destroy'])->name('usuarios.destroy');
// descarga usuarios pdf
Route::get('Usuariospdf',[TblUsuariosController::class, 'pdf'])->name('usuarios.pdf');


// Rutas del modulo Recetas
Route::view("/Recetas", 'usuarios.IndexReceta')->name('recetas.index');


//parte para traer las recetas y mostrarla una por una junto con sus ingredientes y carcularlos
Route::get('/Recetario',[TblRecetaController::class, 'recetario'])->name('receta.recetario');
Route::get('/Receta-Ingredientes/{Id_Receta}', [TblRecetaController::class, 'showingrediente'])->name('receta.ingrediente');
Route::post('/Receta-Ingredientes/{Id_Receta}/Calcular-Porciones', [TblRecetaController::class, 'cantidadmultiplicada'])->name('recetas.cantidadmultiplicada');
Route::post('/Orden-Produccion/crear', [TblOrdenproduccionController::class, 'store'])->name('orden.store');
Route::get('/Ordenes-De-Produccion',[TblOrdenproduccionController::class, 'index'])->name('orden.index');
Route::post('/ordenes/{orden}/detalles', [TblOrdenproduccionController::class,'storeDetalles'])->name('ordenes.detalles.store');
Route::post('/ordenes/detalles/bulk', [TblOrdenproduccionController::class,'storeBulkDetalles'])->name('ordenes.detalles.bulk');
Route::view('/Receta','usuarios.Receta');
Route::get('/ordenes/{orden}/detalles/edit',[TblOrdenproduccionController::class, 'editDetalles'])->name('ordenes.detalles.edit');
Route::put('/ordenes/{orden}/detalles',[TblOrdenproduccionController::class,'updateDetalles'])->name('ordenes.detalles.update');
Route::view('/Orden-Produccion','usuarios.OrdenProduccion')->name('orden.produccion');
Route::post('/orden/{ordenId}/preparacion-iniciar', [TblOrdenproduccionController::class  ,'iniciarPreparacion'])->name('orden.preparacion.iniciar');
Route::post('/orden/{ordenId}/entregado', [TblOrdenproduccionController::class,'marcarComoEntregado'])->name('orden.entregado');
Route::get('/ordenes/espera', [TblOrdenproduccionController::class,'indexOrdenesEspera'])->name('ordenes.espera');
Route::get('/ordenes/preparacion', [TblOrdenProduccionController::class ,'indexOrdenesPreparacion'])->name('ordenes.preparacion');
Route::get('/ordenes/entregadas', [TblOrdenProduccionController::class ,'indexOrdenesEntegadas'])->name('ordenes.entregadas');






Route::get("/FormularioReceta", [TblRecetaController::class, 'create'])->name('receta.create');
Route::post("/FormularioR",[TblRecetaController::class, 'store'])->name("receta.store");

Route::get('/Receta/{Id_Receta}/Editar', [TblRecetaController::class, 'edit'])->name('receta.edit');
Route::put('/Receta/{Id_Receta}', [TblRecetaController::class, 'update'])->name('receta.update');
Route::delete('/Receta/{Id_Receta}', [TblRecetaController::class, 'destroy'])->name('receta.destroy');
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
// descargar pdf de registros de producto
Route::get('/Producto.pdf', [TblProductoController::class, 'pdf'])->name('producto.pdf');





// Rutas de Cliente
Route::get('/RegistrarCliente', [TblClienteController::class, 'create'])->name('clienteCrear');
Route::post('/Clientes', [TblClienteController::class, 'store'])->name('cliente.store');
Route::get('/Cliente/{Id_Cliente}/editar', [TblClienteController::class, 'edit'])->name('cliente.edit');
Route::put('/Cliente/{Id_Cliente}', [TblClienteController::class, 'update'])->name('cliente.update');
Route::delete('/Cliente/{Id_Cliente}', [TblClienteController::class, 'destroy'])->name('cliente.destroy');
// descargar pdf de registros de cliente
Route::get('Clientespdf', [TblClienteController::class, 'pdf'])->name('clientes.pdf');

//Rutas Listas de Chequeo-Edilberto
Route::get('/ListaInicio',[TblTareasController::class,'Inicio'])->name(('lista.inicio'));
Route::post('/enviar-tareas', [TblTareascompletadasController::class, 'store'])->name('listainicio.store');
Route::get("/CrudListaInicio",[TblTareascompletadasController::class, 'indexInicio'])->name('crud.listainicio');
Route::get("/CrudListaFin",[TblTareascompletadasController::class, 'indexFin'])->name('crud.listafin');

Route::get('/ListaFin',[TblTareasController::class,'Fin'])->name(('lista.fin'));
Route::post('/EnviodeTareas',[TblTareascompletadasController::class, 'store'])->name('listafin.store');

