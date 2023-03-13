<?php

use App\Http\Controllers\ClubesController;
use Illuminate\Support\Facades\Route;

Route::get('clubes/listar', [ClubesController::class, 'listar'])->name('clubes.listar');
Route::post('clubes/cadastrar', [ClubesController::class, 'store'])->name('clubes.cadastrar');
Route::post('clubes/consumir-recursos', [ClubesController::class, 'consumirRecursos'])->name('clubes.consumirRecursos');
