<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('projetos', ProjetoController::class);
Route::resource('tarefas', TarefaController::class);
Route::resource('comentarios', ComentarioController::class);
