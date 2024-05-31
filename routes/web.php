<?php
// web.php
use App\Http\Controllers\ArtistaController;
use App\Http\Controllers\AsignacionEntradasController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [EventoController::class, 'showIndex'])->name('home');

Route::get('panelAdmin', function (){
    return view('panelAdmin');
})->name('panelAdmin');

// Rutas para usuarios no autenticados
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::get('/register', [RegisterController::class, 'registerForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
});

// Rutas para usuarios autenticados
Route::get('/users/profile/{id}', [UserController::class, 'verPerfil'])->name('users.profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/sedes/nueva', [SedeController::class, 'create'])->name('formNuevaSede');
    Route::post('/sedes', [SedeController::class, 'nuevaSede'])->name('sedes.store');
    Route::get('/noticias/nueva', [NoticiaController::class, 'create'])->name('formNuevaNoticia');
    Route::post('/noticias', [NoticiaController::class, 'nuevaNoticia'])->name('noticias.store');
    Route::get('/admin/users', [UserController::class, 'listar'])->name('admin.users.index');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{id}', [UserController::class, 'editarPerfil'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::delete('/admin/users/{user}', [UserController::class, 'eliminarUsuario'])->name('users.eliminarUsuario');
    Route::get('/cambiar-contraseña', [UserController::class, 'mostrarFormCambioContraseña'])->name('user.form-cambiar-contraseña')->middleware('auth');
    Route::post('/user/update-password', [UserController::class, 'cambiarContraseña'])->name('user.cambiar-contraseña')->middleware('auth');
});

//Rutas sedes
Route::get('/sedes', [SedeController::class, 'listarSedes'])->name('sedes.listaSedes');
Route::get('/sedes/{id}', [SedeController::class, 'verSede'])->name('sedes.ver');

Route::middleware(['auth'])->group(function () {
    Route::get('/sedes/{id}/editar', [SedeController::class, 'editar'])->name('sedes.editar');
    Route::put('/sedes/{id}', [SedeController::class, 'actualizar'])->name('sedes.actualizar');
    Route::delete('/sedes/{id}', [SedeController::class, 'eliminar'])->name('sedes.eliminar');
});

//Rutas artistas
Route::middleware(['auth'])->group(function () {
    Route::get('/registro/artista', [ArtistaController::class, 'showRegistrationForm'])->name('registro.artista');
    Route::post('/registro/artista', [ArtistaController::class, 'register'])->name('registro.artista.submit');
});

//Rutas eventos
Route::get('/eventos', [EventoController::class, 'listarEventos'])->name('eventos.listar');
Route::get('/eventos/ver/{id}', [EventoController::class, 'verEvento'])->name('eventos.ver');
Route::get('/eventos/buscar', [EventoController::class, 'buscar'])->name('eventos.buscar');
Route::get('/eventos/filtrar', [EventoController::class, 'filtrar'])->name('eventos.filtrar');

Route::middleware(['auth'])->group(function () {
    Route::get('/programar-evento', [EventoController::class, 'mostrarFormularioEvento'])->name('programarEvento');
    Route::post('/programar-evento', [EventoController::class, 'nuevoEvento'])->name('storeEvento');
    Route::get('/eventos/editar/{id}', [EventoController::class, 'editar'])->name('eventos.editar');
    Route::put('/eventos/actualizar/{id}', [EventoController::class, 'actualizar'])->name('eventos.actualizar');
    Route::delete('/eventos/{id}/eliminar', [EventoController::class, 'eliminarEvento'])->name('eventos.eliminar');
});

//Rutas comentarios
Route::middleware(['auth'])->group(function () {
    Route::post('/eventos/{eventoId}/comentarios', [EventoController::class, 'guardarComentario'])->name('eventos.guardar_comentario');
});

//Rutas noticias
Route::get('/noticias', [NoticiaController::class, 'listarNoticias'])->name('noticias.index');
Route::get('/noticias/{id}', [NoticiaController::class, 'verNoticia'])->name('noticias.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/noticias/{noticia}/edit', [NoticiaController::class, 'edit'])->name('noticias.edit');
    Route::put('/noticias/{noticia}', [NoticiaController::class, 'editarNoticia'])->name('noticias.update');
    Route::delete('/noticias/{noticia}', [NoticiaController::class, 'eliminarNoticia'])->name('noticias.destroy');
});

//Rutas compra entradas
Route::middleware(['auth'])->group(function () {
    Route::get('/eventos/{evento}/comprar', [AsignacionEntradasController::class, 'mostrarCompraEntradas'])->name('entradas.mostrar_compra');
    Route::post('/eventos/{evento}/comprar', [AsignacionEntradasController::class, 'comprarEntradas'])->name('entradas.comprar');
    Route::get('/eventos/{idEvento}/confirmar-cancelacion', [AsignacionEntradasController::class, 'mostrarConfirmacionCancelacion'])->name('entradas.confirmar_cancelacion');
    Route::delete('/eventos/{idEvento}/cancelar', [AsignacionEntradasController::class, 'cancelarCompra'])->name('entradas.cancelar');
});

//Rutas correos
Route::middleware(['auth'])->group(function () {
    Route::post('/eventos/{evento}/cancel', [EventoController::class, 'cancelarEvento'])->name('eventos.cancel');
});
