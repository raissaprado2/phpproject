@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Criar Nova Tarefa</h1>

    <!-- Exibir mensagens de erro -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulário para criar uma nova tarefa -->
    <form action="{{ route('tarefas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="{{ old('titulo') }}" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" class="form-control">{{ old('descricao') }}</textarea>
        </div>
        <div class="form-group">
            <label for="prioridade">Prioridade:</label>
            <select name="prioridade" id="prioridade" class="form-control" required>
                <option value="">Selecione a Prioridade</option>
                <option value="Baixa" {{ old('prioridade') == 'Baixa' ? 'selected' : '' }}>Baixa</option>
                <option value="Média" {{ old('prioridade') == 'Média' ? 'selected' : '' }}>Média</option>
                <option value="Alta" {{ old('prioridade') == 'Alta' ? 'selected' : '' }}>Alta</option>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control" required>
                <option value="">Selecione o Status</option>
                <option value="Pendente" {{ old('status') == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="Em Andamento" {{ old('status') == 'Em Andamento' ? 'selected' : '' }}>Em Andamento</option>
                <option value="Concluído" {{ old('status') == 'Concluído' ? 'selected' : '' }}>Concluído</option>
            </select>
        </div>
        <div class="form-group">
            <label for="data_vencimento">Data de Vencimento:</label>
            <input type="date" name="data_vencimento" id="data_vencimento" class="form-control" value="{{ old('data_vencimento') }}" required>
        </div>
        <div class="form-group">
            <label for="projeto_id">Projeto:</label>
            <select name="projeto_id" id="projeto_id" class="form-control" required>
                <option value="">Selecione o Projeto</option>
                @foreach ($projetos as $projeto)
                    <option value="{{ $projeto->id }}" {{ old('projeto_id') == $projeto->id ? 'selected' : '' }}>
                        {{ $projeto->nome }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="responsavel_id">Responsável:</label>
            <select name="responsavel_id" id="responsavel_id" class="form-control" required>
                <option value="">Selecione o Responsável</option>
                @foreach ($responsaveis as $responsavel)
                    <option value="{{ $responsavel->id }}" {{ old('responsavel_id') == $responsavel->id ? 'selected' : '' }}>
                        {{ $responsavel->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('tarefas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
