@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Comentários da Tarefa: {{ $tarefa->titulo }}</h1>

    <!-- Mensagens de sucesso -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulário para criar um novo comentário -->
    <form action="{{ route('comentarios.store') }}" method="POST">
        @csrf
        <input type="hidden" name="tarefa_id" value="{{ $tarefa->id }}">
        <div class="form-group">
            <label for="conteudo">Novo Comentário:</label>
            <textarea name="conteudo" id="conteudo" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Adicionar Comentário</button>
    </form>

    <h2 class="mt-4">Comentários</h2>

    <!-- Tabela para listar comentários -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Conteúdo</th>
                <th>Data de Criação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($comentarios as $comentario)
                <tr>
                    <td>{{ $comentario->id }}</td>
                    <td>{{ $comentario->conteudo }}</td>
                    <td>{{ $comentario->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <!-- Link para visualizar comentário -->
                        <a href="{{ route('comentarios.show', $comentario->id) }}" class="btn btn-info btn-sm">Visualizar</a>

                        <!-- Formulário para deletar comentário -->
                        <form action="{{ route('comentarios.destroy', $comentario->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja deletar este comentário?')">Deletar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Nenhum comentário encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
