@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tarefas</h1>

    <!-- Mensagens de sucesso -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Link para criar uma nova tarefa -->
    <a href="{{ route('tarefas.create') }}" class="btn btn-primary mb-3">Criar Nova Tarefa</a>

    <!-- Tabela para listar tarefas -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Prioridade</th>
                <th>Status</th>
                <th>Data de Vencimento</th>
                <th>Projeto</th>
                <th>Responsável</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tarefas as $tarefa)
                <tr>
                    <td>{{ $tarefa->id }}</td>
                    <td>{{ $tarefa->titulo }}</td>
                    <td>{{ $tarefa->descricao }}</td>
                    <td>{{ $tarefa->prioridade }}</td>
                    <td>{{ $tarefa->status }}</td>
                    <td>{{ $tarefa->data_vencimento->format('d/m/Y') }}</td>
                    <td>{{ $tarefa->projeto->nome }}</td>
                    <td>{{ $tarefa->responsavel->name }}</td>
                    <td>
                        <!-- Links para visualizar, editar e deletar tarefa -->
                        <a href="{{ route('tarefas.show', $tarefa->id) }}" class="btn btn-info btn-sm">Visualizar</a>
                        <a href="{{ route('tarefas.edit', $tarefa->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <!-- Formulário para deletar tarefa -->
                        <form action="{{ route('tarefas.destroy', $tarefa->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja deletar esta tarefa?')">Deletar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Nenhuma tarefa encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
