<?php
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/migrar', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        return 'Migraciones ejecutadas ✅';
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

Route::get('/debug-tablas', function () {
    try {
        $tablas = DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'");
        return response()->json($tablas);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

Route::get('/fix-migracion', function () {
    DB::table('migrations')->where('migration', 'like', '%add_imagen%')->delete();
    return 'Migración eliminada de la tabla migrations ✅';
});

Route::get('/limpiar-migraciones', function () {
    try {
        DB::table('migrations')->truncate();
        return 'Tabla de migraciones vaciada ✅';
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

Route::get('/borrar-tablas', function () {
    // Desactivar restricciones de clave foránea temporalmente
    DB::statement('SET session_replication_role = replica;');

    $tablas = [
        'detalle_pedidos',
        'pedidos',
        'detalle_reservas',
        'reservas',
        'comentarios',
        'platos',
        'usuarios',
        'personal_access_tokens',
        'migrations'
    ];

    foreach ($tablas as $tabla) {
        Schema::dropIfExists($tabla);
    }

    // Reactivar restricciones
    DB::statement('SET session_replication_role = DEFAULT;');

    return 'Tablas eliminadas ✅';
});