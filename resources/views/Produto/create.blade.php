@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('produto.store') }}" method="post">
            @csrf
            <div class="my-3">
                <label for="id-input-id" class="form-label">ID</label>
                <input type="text" class="form-control" id="id-input-id" aria-describedby="id-help-id" value="#"
                    disabled>
                <div id="id-help-id" class="form-text">Não é necessário informar o ID para cadastrar um novo dado.</div>
            </div>
            <div class="my-3">
                <label for="id-input-nome" class="form-label">Nome</label>
                <input name="nome" type="text" class="form-control" id="id-input-nome" placeholder="Digite o nome"
                    required>
            </div>
            <div class="my-3">
                <label for="id-input-preco" class="form-label">Preço</label>
                <input name="preco" type="number" class="form-control" step=".01" id="id-input-preco"
                    placeholder="Digite o preço" required>
            </div>
            <div class="my-3">
                <label for="id-input-Tipo_Produtos_id" class="form-label">Tipo</label>
                <select name="Tipo_Produtos_id" class="form-select">
                    @foreach ($tipoProdutos as $tipoProduto)
                        <option value="{{ $tipoProduto->id }}">{{ $tipoProduto->descricao }}</option>
                    @endforeach
                </select>
                {{-- <input name="Tipo_Produtos_id" type="text" class="form-control" id="id-input-Tipo_Produtos_id" placeholder="Digite o tipo"> --}}
            </div>
            <div class="my-3">
                <label for="id-input-ingredientes" class="form-label">Ingredientes</label>
                <input name="ingredientes" type="text" class="form-control" id="id-input-ingredientes"
                    placeholder="Digite os ingredientes" required>
            </div>
            <div class="my-3">
                <label for="id-input-urlImage" class="form-label">Url Image</label>
                <input name="urlImage" type="text" class="form-control" id="id-input-urlImage"
                    placeholder="Digite a url image" required>
            </div>
            <div class="my-3">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{ route('produto.index') }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>
@endsection
