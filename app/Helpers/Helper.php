<?php

use App\Models\User;
use Illuminate\Support\Facades\File;

function subirAFile($file, $user_id, $folder)
{
    // eliminamos la imagen anterior
    $user = User::find($user_id);
    if ($user->avatar) {
        File::delete($user->avatar);
    }

    // Crear directorios para guardar los archivos
    $base_path = 'files/';
    $folders = [
        $folder,
    ];

    // Asegurar que se creen los directorios con los permisos correctos
    $path = asignarPermisoFolders($base_path, $folders);

    // Nombre del archivo
    $filename = time() . uniqid() . '.' . $file->getClientOriginalExtension();
    $nombre_db = $path . $filename;

    // Guardar el archivo
    $file->storeAs($path, $filename, 'public');

    // Asignar todos los permisos al archivo
    chmod($nombre_db, 0777);

    return $nombre_db;
}

function asignarPermisoFolders($base_path, $folders)
{
    $path = $base_path;
    foreach ($folders as $folder) {
        $path .= $folder . '/';
        // Asegurar que se creen los directorios con los permisos correctos
        $parent_directory = dirname($path);
        if (!file_exists($parent_directory)) {
            mkdir($parent_directory, 0777, true); // Establecer permisos en el directorio padre
        }
        if (!file_exists($path)) {
            mkdir($path, 0777, true); // 0777 establece todos los permisos para el directorio
            // Cambiar el modo de permisos después de crear los directorios
            chmod($path, 0777);
        }
    }
    return $path;
}

//
