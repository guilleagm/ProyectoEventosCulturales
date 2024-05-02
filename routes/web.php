<?php
// web.php
use App\Http\Controllers\ArtistaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\UserArtistaFavController;
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
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::delete('/admin/users/{user}', [UserController::class, 'eliminarUsuario'])->name('users.eliminarUsuario');
Route::delete('/usuarios/{usuario}/artistas/{artista}/eliminar_favorito', [App\Http\Controllers\UserArtistaFavController::class, 'eliminarFavorito'])->name('usuarios.artistas.eliminar_favorito');


//Rutas artistas
Route::get('/registro/artista', [ArtistaController::class, 'showRegistrationForm'])->name('registro.artista');
Route::post('/registro/artista', [ArtistaController::class, 'register'])->name('registro.artista.submit');
Route::get('/', [ArtistaController::class, 'verificarArtista']);
Route::post('/usuarios/{usuario}/artistas/{artista}/favoritos', [UserArtistaFavController::class, 'agregarFavorito'])->name('usuarios.artistas.agregar_favorito');

//Rutas eventos
Route::get('/programar-evento', [EventoController::class, 'mostrarFormularioEvento'])->name('programarEvento');
Route::post('/programar-evento', [EventoController::class, 'nuevoEvento'])->name('storeEvento');
Route::get('/eventos', [EventoController::class, 'listarEventos'])->name('eventos.listar');
Route::get('/eventos/ver/{id}', [EventoController::class, 'verEvento'])->name('eventos.ver');
Route::get('/eventos/editar/{id}', [EventoController::class, 'editar'])->name('eventos.editar');
Route::put('/eventos/actualizar/{id}', [EventoController::class, 'actualizar'])->name('eventos.actualizar');

//Rutas comentarios
Route::post('/eventos/{eventoId}/comentarios', [EventoController::class, 'guardarComentario'])->name('eventos.guardar_comentario');

//Rutas noticias
Route::get('/noticias', [NoticiaController::class, 'listarNoticias'])->name('noticias.index');
Route::get('/noticias/{id}', [NoticiaController::class, 'verNoticia'])->name('noticias.show');
Route::get('/noticias/{noticia}/edit', [NoticiaController::class, 'edit'])->name('noticias.edit');
Route::put('/noticias/{noticia}', [NoticiaController::class, 'update'])->name('noticias.update');
Route::delete('/noticias/{noticia}', [NoticiaController::class, 'destroy'])->name('noticias.destroy');
