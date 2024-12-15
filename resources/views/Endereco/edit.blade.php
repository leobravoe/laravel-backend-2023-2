@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('endereco.update', $endereco->id) }}" method="post">
            @csrf
            @method('put')
            <div class="my-3">
                <label for="id-input-id" class="form-label">ID</label>
                <input type="text" class="form-control" id="id-input-id" aria-describedby="id-help-id"
                    value="{{ $endereco->id }}" disabled>
                <div id="id-help-id" class="form-text">Não é necessário informar o ID para cadastrar um novo dado.</div>
            </div>
            <div class="my-3">
                <label for="id-input-bairro" class="form-label">bairro</label>
                <input name="bairro" type="text" class="form-control" id="id-input-bairro"
                    placeholder="Digite a descrição" value="{{ $endereco->bairro }}">
            </div>
            <div class="my-3">
                <label for="id-input-logradouro" class="form-label">logradouro</label>
                <input name="logradouro" type="text" class="form-control" id="id-input-logradouro"
                    placeholder="Digite a descrição" value="{{ $endereco->logradouro }}">
            </div>
            <div class="my-3">
                <label for="id-input-numero" class="form-label">numero</label>
                <input name="numero" type="text" class="form-control" id="id-input-numero"
                    placeholder="Digite a descrição" value="{{ $endereco->numero }}">
            </div>
            <div class="my-3">
                <label for="id-input-complemento" class="form-label">complemento</label>
                <input name="complemento" type="text" class="form-control" id="id-input-complemento"
                    placeholder="Digite a descrição" value="{{ $endereco->complemento }}">
            </div>
            <div class="my-3">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{ route('endereco.index') }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>
@endsection
