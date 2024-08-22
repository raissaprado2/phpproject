<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Tarefa;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    // Construtor para aplicar middleware de autenticação
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // Mostrar uma lista de comentários
    public function index()
    {
        $comentarios = Comentario::with('tarefa')->get(); // Recupera todos os comentários com o relacionamento de tarefa
        return view('comentarios.index', compact('comentarios'));
    }

    // Mostrar o formulário para criar um novo comentário
    public function create()
    {
        $tarefas = Tarefa::all(); // Recupera todas as tarefas para associar ao comentário
        return view('comentarios.create', compact('tarefas'));
    }

    // Armazenar um novo comentário no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'texto' => 'required|string',
            'tarefa_id' => 'required|exists:tarefas,id',
        ]);

        Comentario::create([
            'texto' => $request->texto,
            'tarefa_id' => $request->tarefa_id,
            'autor_id' => auth()->id(), // Assume que o usuário autenticado é o autor do comentário
        ]);

        return redirect()->route('comentarios.index')->with('success', 'Comentário criado com sucesso!');
    }

    // Mostrar detalhes de um comentário específico
    public function show(Comentario $comentario)
    {
        return view('comentarios.show', compact('comentario'));
    }

    // Mostrar o formulário para editar um comentário específico
    public function edit(Comentario $comentario)
    {
        $tarefas = Tarefa::all(); // Recupera todas as tarefas para associar ao comentário
        return view('comentarios.edit', compact('comentario', 'tarefas'));
    }

    // Atualizar um comentário específico no banco de dados
    public function update(Request $request, Comentario $comentario)
    {
        $request->validate([
            'texto' => 'required|string',
            'tarefa_id' => 'required|exists:tarefas,id',
        ]);

        $comentario->update([
            'texto' => $request->texto,
            'tarefa_id' => $request->tarefa_id,
            'autor_id' => auth()->id(), // Assume que o usuário autenticado é o autor do comentário
        ]);

        return redirect()->route('comentarios.index')->with('success', 'Comentário atualizado com sucesso!');
    }

    // Remover um comentário específico do banco de dados
    public function destroy(Comentario $comentario)
    {
        $comentario->delete();
        return redirect()->route('comentarios.index')->with('success', 'Comentário deletado com sucesso!');
    }
}
