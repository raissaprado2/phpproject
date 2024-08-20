<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Models\Projeto;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    // Construtor para aplicar middleware de autenticação
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Mostrar uma lista de tarefas
    public function index()
    {
        $tarefas = Tarefa::with('projeto')->get(); // Recupera todas as tarefas com o relacionamento de projeto
        return view('tarefas.index', compact('tarefas'));
    }

    // Mostrar o formulário para criar uma nova tarefa
    public function create()
    {
        $projetos = Projeto::all(); // Recupera todos os projetos para associar à tarefa
        return view('tarefas.create', compact('projetos'));
    }

    // Armazenar uma nova tarefa no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'prioridade' => 'required|string|in:Baixa,Média,Alta',
            'status' => 'required|string|in:Pendente,Em Progresso,Concluída',
            'data_vencimento' => 'required|date',
            'projeto_id' => 'required|exists:projetos,id',
            'responsavel_id' => 'required|exists:users,id',
        ]);

        Tarefa::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'prioridade' => $request->prioridade,
            'status' => $request->status,
            'data_vencimento' => $request->data_vencimento,
            'projeto_id' => $request->projeto_id,
            'responsavel_id' => $request->responsavel_id,
        ]);

        return redirect()->route('tarefas.index')->with('success', 'Tarefa criada com sucesso!');
    }

    // Mostrar detalhes de uma tarefa específica
    public function show(Tarefa $tarefa)
    {
        return view('tarefas.show', compact('tarefa'));
    }

    // Mostrar o formulário para editar uma tarefa específica
    public function edit(Tarefa $tarefa)
    {
        $projetos = Projeto::all(); // Recupera todos os projetos para associar à tarefa
        return view('tarefas.edit', compact('tarefa', 'projetos'));
    }

    // Atualizar uma tarefa específica no banco de dados
    public function update(Request $request, Tarefa $tarefa)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'prioridade' => 'required|string|in:Baixa,Média,Alta',
            'status' => 'required|string|in:Pendente,Em Progresso,Concluída',
            'data_vencimento' => 'required|date',
            'projeto_id' => 'required|exists:projetos,id',
            'responsavel_id' => 'required|exists:users,id',
        ]);

        $tarefa->update([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'prioridade' => $request->prioridade,
            'status' => $request->status,
            'data_vencimento' => $request->data_vencimento,
            'projeto_id' => $request->projeto_id,
            'responsavel_id' => $request->responsavel_id,
        ]);

        return redirect()->route('tarefas.index')->with('success', 'Tarefa atualizada com sucesso!');
    }

    // Remover uma tarefa específica do banco de dados
    public function destroy(Tarefa $tarefa)
    {
        $tarefa->delete();
        return redirect()->route('tarefas.index')->with('success', 'Tarefa deletada com sucesso!');
    }
}
