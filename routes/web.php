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

// Rutas del modulo Recetas
Route::view("/Recetas", 'usuarios.IndexReceta')->name('recetas.index');


//parte para traer las recetas y mostrarla una por una junto con sus ingredientes y carcularlos
Route::get('/Recetario',[TblRecetaController::class, 'recetario'])->name('receta.recetario');
Route::get('/Receta-Ingredientes/{Id_Receta}', [TblRecetaController::class, 'showingrediente'])->name('receta.ingrediente');
Route::post('/Receta-Ingredientes/{Id_Receta}/Calcular-Porciones', [TblRecetaController::class, 'cantidadmultiplicada'])->name('recetas.cantidadmultiplicada');
Route::view('/Receta','usuarios.Receta');




Route::get("/FormularioReceta", [TblRecetaController::class, 'create'])->name('receta.create');
Route::post("/FormularioR",[TblRecetaController::class, 'store'])->name("receta.store");
Route::get('/Receta/{Id_Receta}/Editar', [TblRecetaController::class, 'edit'])->name('receta.edit');
Route::put('/Receta/{Id_Receta}', [TblRecetaController::class, 'update'])->name('receta.update');
Route::delete('/Receta/{Id_Receta}', [TblRecetaController::class, 'destroy'])->name('receta.destroy');

// Rutas de detalle receta
Route::get("/FDetalleReceta", [TblDetallerecetaController::class, 'create'])->name('detalleReceta.create');
Route::post("/FormularioDR",[TblDetallerecetaController::class, 'store'])->name("detalleReceta.store");

// Rutas de producto
Route::get('FormularioProductos', [TblProductoController::class, 'create'])->name('producto.create');
Route::post('Producto', [TblProductoController::class, 'store'])->name('producto.store');
Route::get('/Producto/{Cod_Producto}/Editar', [TblProductoController::class, 'edit'])->name('producto.edit');
Route::put('/Producto/{Cod_Producto}', [TblProductoController::class, 'update'])->name('producto.update');
Route::delete('/Producto/{Cod_Producto}', [TblProductoController::class, 'destroy'])->name('producto.destroy');


// Rutas de Cliente
Route::get('/RegistrarCliente', [TblClienteController::class, 'create'])->name('clienteCrear');
Route::post('/Clientes', [TblClienteController::class, 'store'])->name('cliente.store');
Route::get('/Cliente/{Id_Cliente}/editar', [TblClienteController::class, 'edit'])->name('cliente.edit');
Route::put('/Cliente/{Id_Cliente}', [TblClienteController::class, 'update'])->name('cliente.update');
Route::delete('/Cliente/{Id_Cliente}', [TblClienteController::class, 'destroy'])->name('cliente.destroy');

//Rutas Listas de Chequeo-Edilberto
Route::get('/ListaInicio',[TblTareasController::class,'Inicio'])->name(('lista.inicio'));
Route::post('/enviar-tareas', [TblTareascompletadasController::class, 'store'])->name('listainicio.store');
Route::get('/ListaFin',[TblTareasController::class,'Fin'])->name(('lista.fin'));
Route::post('/EnviodeTareas',[TblTareascompletadasController::class, 'store'])->name('listafin.store');

