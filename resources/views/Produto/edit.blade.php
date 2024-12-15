@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('produto.update', $produto->id) }}" method="post">
            @csrf
            @method('put')
            <div class="my-3">
                <label for="id-input-id" class="form-label">ID</label>
                <input type="text" class="form-control" id="id-input-id" aria-describedby="id-help-id"
                    value="{{ $produto->id }}" disabled>
                <div id="id-help-id" class="form-text">Não é necessário informar o ID para cadastrar um novo dado.</div>
            </div>
            <div class="my-3">
                <label for="id-input-nome" class="form-label">Nome</label>
                <input name="nome" type="text" class="form-control" id="id-input-nome" placeholder="Digite o nome"
                    value="{{ $produto->nome }}" required>
            </div>
            <div class="my-3">
                <label for="id-input-preco" class="form-label">Preço</label>
                <input name="preco" type="number" step="0.01" class="form-control" id="id-input-preco"
                    placeholder="Digite o preço" value="{{ $produto->preco }}" required>
            </div>
            <div class="my-3">
                <label for="id-input-Tipo_Produtos_id" class="form-label">Tipo</label>
                <select name="Tipo_Produtos_id" class="form-select">
                    @foreach ($tipoProdutos as $tipoProduto)
                        @if ($produto->Tipo_Produtos_id == $tipoProduto->id)
                            <option value="{{ $tipoProduto->id }}" selected>{{ $tipoProduto->descricao }}</option>
                        @else
                            <option value="{{ $tipoProduto->id }}">{{ $tipoProduto->descricao }}</option>
                        @endif
                    @endforeach
                </select>
                {{-- <input name="Tipo_Produtos_id" type="text" class="form-control" id="id-input-Tipo_Produtos_id" placeholder="Digite o tipo"> --}}
            </div>
            <div class="my-3">
                <label for="id-input-ingredientes" class="form-label">Ingredientes</label>
                <input name="ingredientes" type="text" class="form-control" id="id-input-ingredientes"
                    placeholder="Digite os ingredientes" value="{{ $produto->ingredientes }}" required>
            </div>
            <div class="my-3">
                <label for="id-input-urlImage" class="form-label">Url Image</label>
                <input name="urlImage" type="text" class="form-control" id="id-input-urlImage"
                    placeholder="Digite a url image" value="{{ $produto->urlImage }}" required>
            </div>
            <div class="my-3">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{ route('produto.index') }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>
@endsection
