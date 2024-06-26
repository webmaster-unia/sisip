<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login as AuthLogin;
use App\Livewire\Home\Index as HomeIndex;
use App\Livewire\Configuracion\Usuario\Index as ConfiguracionUsuarioIndex;
use App\Livewire\Configuracion\Rol\Index as ConfiguracionRolIndex;
use App\Livewire\Configuracion\Permiso\Index as ConfiguracionPermisoIndex;
use App\Livewire\Cargo\Index as CargoIndex;
use App\Livewire\Ip\Index as IpIndex;
use App\Livewire\Area\Index as AreaIndex;
use App\Livewire\Asignar\Index as AsignarIndex;


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

        //ruta para IP
        Route::get('/ip',IpIndex::class)
        ->middleware('auth')
        ->name('ip.index');

    //ruta para AsigArea
    Route::get('/asignar',AsignarIndex::class)
    ->middleware('auth')
    ->name('asignar.index');

        Route::post('/generar-ips', [IpIndex::class, 'generarYGuardarIPs'])
        ->middleware('auth')
        ->name('ip.genera








































































        r_ips');

        //Ruta para area
        Route::get('/area', AreaIndex::class)
        ->middleware('auth')
        ->name('area.index');
        //ruta para cargos
        Route::get('/cargo', CargoIndex::class)
        ->middleware('auth')
        ->name('cargo.index');
});














