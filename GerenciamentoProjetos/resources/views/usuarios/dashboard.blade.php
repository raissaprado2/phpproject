@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bem-vindo ao Dashboard</h1>
    <p>Olá, {{ Auth::user()->name }}! Aqui está seu painel de controle.</p>
    <!-- Adicione mais conteúdo para o dashboard conforme necessário -->
</div>
@endsection
