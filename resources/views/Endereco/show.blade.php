@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-2">
            <label for="id-input-id" class="form-label">ID</label>
            <input id="id-input-id" type="text" class="form-control" value="{{ $endereco->id }}" disabled>
        </div>
        <div class="my-2">
            <label for="id-input-bairro" class="form-label">bairro</label>
            <input id="id-input-bairro" type="text" class="form-control" value="{{ $endereco->bairro }}" disabled>
        </div>
        <div class="my-2">
            <label for="id-input-logradouro" class="form-label">logradouro</label>
            <input id="id-input-logradouro" type="text" class="form-control" value="{{ $endereco->logradouro }}"
                disabled>
        </div>
        <div class="my-2">
            <label for="id-input-numero" class="form-label">numero</label>
            <input id="id-input-numero" type="text" class="form-control" value="{{ $endereco->numero }}" disabled>
        </div>
        <div class="my-2">
            <label for="id-input-complemento" class="form-label">complemento</label>
            <input id="id-input-complemento" type="text" class="form-control" value="{{ $endereco->complemento }}"
                disabled>
        </div>
        <div class="my-2">
            <label for="id-input-updated_at" class="form-label">Última atualização</label>
            <input id="id-input-updated_at" type="text" class="form-control" value="{{ $endereco->updated_at }}"
                disabled>
        </div>
        <div class="my-2">
            <label for="id-input-created_at" class="form-label">Data de criação</label>
            <input id="id-input-created_at" type="text" class="form-control" value="{{ $endereco->created_at }}"
                disabled>
        </div>
        <div>
            <a href="{{ route('endereco.index') }}" class="btn btn-primary">Voltar</a>
        </div>
    </div>
@endsection
