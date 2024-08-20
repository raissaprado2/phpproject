<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use Illuminate\Http\Request;

class ProjetoController extends Controller
{
    // Construtor para aplicar middleware de autenticação
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Mostrar uma lista de projetos
    public function index()
    {
        $projetos = Projeto::all(); // Ou use paginate() se houver muitos projetos
        return view('projetos.index', compact('projetos'));
    }

    // Mostrar o formulário para criar um novo projeto
    public function create()
    {
        return view('projetos.create');
    }

    // Armazenar um novo projeto no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'status' => 'required|string|in:Ativo,Concluído,Suspenso',
        ]);

        Projeto::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim,
            'status' => $request->status,
        ]);

        return redirect()->route('projetos.index')->with('success', 'Projeto criado com sucesso!');
    }

    // Mostrar detalhes de um projeto específico
    public function show(Projeto $projeto)
    {
        return view('projetos.show', compact('projeto'));
    }

    // Mostrar o formulário para editar um projeto específico
    public function edit(Projeto $projeto)
    {
        return view('projetos.edit', compact('projeto'));
    }

    // Atualizar um projeto específico no banco de dados
    public function update(Request $request, Projeto $projeto)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'status' => 'required|string|in:Ativo,Concluído,Suspenso',
        ]);

        $projeto->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim,
            'status' => $request->status,
        ]);

        return redirect()->route('projetos.index')->with('success', 'Projeto atualizado com sucesso!');
    }

    // Remover um projeto específico do banco de dados
    public function destroy(Projeto $projeto)
    {
        $projeto->delete();
        return redirect()->route('projetos.index')->with('success', 'Projeto deletado com sucesso!');
    }
}
