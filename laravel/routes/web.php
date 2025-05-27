<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return '✅ Backend Laravel funcionando en Railway';
});
Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});