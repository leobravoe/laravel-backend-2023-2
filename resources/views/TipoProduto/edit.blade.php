@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('tipoproduto.update', $tipoProduto->id) }}" method="post">
            @csrf
            @method('put')
            <div class="my-3">
                <label for="id-input-id" class="form-label">ID</label>
                <input type="text" class="form-control" id="id-input-id" aria-describedby="id-help-id"
                    value="{{ $tipoProduto->id }}" disabled>
                <div id="id-help-id" class="form-text">Não é necessário informar o ID para cadastrar um novo dado.</div>
            </div>
            <div class="my-3">
                <label for="id-input-descricao" class="form-label">Descrição</label>
                <input name="descricao" type="text" class="form-control" id="id-input-descricao"
                    placeholder="Digite a descrição" value="{{ $tipoProduto->descricao }}">
            </div>
            <div class="my-3">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{ route('tipoproduto.index') }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>
@endsection
