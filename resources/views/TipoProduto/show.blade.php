@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-2">
            <label for="id-input-id" class="form-label">ID</label>
            <input id="id-input-id" type="text" class="form-control" value="{{ $tipoProduto->id }}" disabled>
        </div>
        <div class="my-2">
            <label for="id-input-descricao" class="form-label">Descrição</label>
            <input id="id-input-descricao" type="text" class="form-control" value="{{ $tipoProduto->descricao }}"
                disabled>
        </div>
        <div class="my-2">
            <label for="id-input-updated_at" class="form-label">Última atualização</label>
            <input id="id-input-updated_at" type="text" class="form-control" value="{{ $tipoProduto->updated_at }}"
                disabled>
        </div>
        <div class="my-2">
            <label for="id-input-created_at" class="form-label">Data de criação</label>
            <input id="id-input-created_at" type="text" class="form-control" value="{{ $tipoProduto->created_at }}"
                disabled>
        </div>
        <div>
            <a href="{{ route('tipoproduto.index') }}" class="btn btn-primary">Voltar</a>
        </div>
    </div>
@endsection
