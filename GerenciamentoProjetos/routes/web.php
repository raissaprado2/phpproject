<?php

use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\TarefaController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('projetos', \App\Http\Controllers\ProjetoController::class);
Route::resource('tarefas', \App\Http\Controllers\TarefaController::class);
Route::resource('comentarios', \App\Http\Controllers\ComentarioController::class);

Route::get('/login', [UsuarioController::class, 'showLoginForm'])->
name('usuarios.login');

// Rota para processar o login
Route::post('/login', [UsuarioController::class, 'login'])->
name('usuarios.login');

// Rota para exibir o formulário de registro
Route::get('/registro', [UsuarioController::class, 'showRegistroForm'])->
name('usuarios.registro');

// Rota para processar o registro
Route::post('/registro', [UsuarioController::class, 'registro'])->
name('usuarios.registro');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
