@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Projetos</h1>

    <!-- Mensagens de sucesso -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Link para criar um novo projeto -->
    <a href="{{ route('projetos.create') }}" class="btn btn-primary mb-3">Criar Novo Projeto</a>

    <!-- Tabela para listar projetos -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Data Início</th>
                <th>Data Fim</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projetos as $projeto)
                <tr>
                    <td>{{ $projeto->id }}</td>
                    <td>{{ $projeto->nome }}</td>
                    <td>{{ $projeto->descricao }}</td>
                    <td>{{ $projeto->data_inicio->format('d/m/Y') }}</td>
                    <td>{{ $projeto->data_fim->format('d/m/Y') }}</td>
                    <td>{{ $projeto->status }}</td>
                    <td>
                        <!-- Links para visualizar, editar e deletar projeto -->
                        <a href="{{ route('projetos.show', $projeto->id) }}" class="btn btn-info btn-sm">Visualizar</a>
                        <a href="{{ route('projetos.edit', $projeto->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <!-- Formulário para deletar projeto -->
                        <form action="{{ route('projetos.destroy', $projeto->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja deletar este projeto?')">Deletar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Nenhum projeto encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
