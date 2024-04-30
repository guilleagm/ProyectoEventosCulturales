<?php
// web.php
use App\Http\Controllers\ArtistaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Rutas para usuarios no autenticados
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::get('/register', [RegisterController::class, 'registerForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
});

// Rutas para usuarios autenticados
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/sedes/nueva', [SedeController::class, 'create'])->name('formNuevaSede');
    Route::post('/sedes', [SedeController::class, 'store'])->name('sedes.store');
    Route::get('/noticias/nueva', [NoticiaController::class, 'create'])->name('formNuevaNoticia');
    Route::post('/noticias', [NoticiaController::class, 'store'])->name('noticias.store');
});

// Ruta principal
Route::get('/', function () {
    return view('index');
})->name('home');

//Rutas sedes
Route::get('/sedes', [SedeController::class, 'listarSedes'])->name('sedes.listaSedes');

//Rutas usuarios
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'listar'])->name('admin.users.index');
    Route::get('/users/profile/{id}', [UserController::class, 'verPerfil'])->name('users.profile');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::delete('/admin/users/{user}', [UserController::class, 'eliminarUsuario'])->name('users.eliminarUsuario');

//Rutas artistas
Route::get('/registro/artista', [ArtistaController::class, 'showRegistrationForm'])->name('registro.artista');
Route::post('/registro/artista', [ArtistaController::class, 'register'])->name('registro.artista.submit');

//Rutas eventos
Route::get('/programar-evento', [EventoController::class, 'mostrarFormularioEvento'])->name('programarEvento');
Route::post('/programar-evento', [EventoController::class, 'nuevoEvento'])->name('storeEvento');
Route::get('/eventos', [EventoController::class, 'listarEventos'])->name('eventos.listar');
Route::get('/eventos/ver/{id}', [EventoController::class, 'verEvento'])->name('eventos.ver');
Route::get('/eventos/editar/{id}', [EventoController::class, 'editar'])->name('eventos.editar');
Route::put('/eventos/actualizar/{id}', [EventoController::class, 'actualizar'])->name('eventos.actualizar');

//Rutas comentarios
Route::post('/eventos/{eventoId}/comentarios', [EventoController::class, 'guardarComentario'])->name('eventos.guardar_comentario');
