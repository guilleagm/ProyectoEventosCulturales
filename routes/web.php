<?php
// web.php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\SedeController;
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
