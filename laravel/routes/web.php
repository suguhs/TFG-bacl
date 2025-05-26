<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/debug-tablas', function () {
    try {
        $tablas = DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'");
        return response()->json($tablas);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});
