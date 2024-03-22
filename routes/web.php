<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Auth\Login as AuthLogin;
use App\Livewire\Home\Index as HomeIndex;
use App\Livewire\Configuracion\Usuario\Index as ConfiguracionUsuarioIndex;
use App\Livewire\Configuracion\Rol\Index as ConfiguracionRolIndex;
use App\Livewire\Configuracion\Permiso\Index as ConfiguracionPermisoIndex;
use App\Livewire\Ip\Index as IpIndex;
use App\Livewire\Configuracion\Permiso\Index as AreaIndex;

// ruta que redirige al home
Route::redirect('/', '/home');
// ruta para el login
Route::get('/login', AuthLogin::class)
    ->middleware('guest')
    ->name('login');
// routa para el home
Route::get('/home', HomeIndex::class)
    ->middleware('auth')
    ->name('home.index');
// rutas para la configuracion
Route::prefix('configuracion')->group(function () {
    // rutas para la configuracion de usuarios
    Route::get('/usuarios', ConfiguracionUsuarioIndex::class)
        ->middleware('auth')
        ->name('configuracion.usuario.index');
    // rutas para la configuracion de roles
    Route::get('/roles', ConfiguracionRolIndex::class)
        ->middleware('auth')
        ->name('configuracion.rol.index');
    // rutas para la configuracion de permisos
    Route::get('/permisos', ConfiguracionPermisoIndex::class)
        ->middleware('auth')
        ->name('configuracion.permiso.index');

});
//ruta para IP
Route::get('/ip',IpIndex::class)
    ->middleware('auth')
    ->name('ip.index');
//Ruta para area
Route::get('/area', AreaIndex::class)
    ->middleware('auth')
    ->name('area.index');
