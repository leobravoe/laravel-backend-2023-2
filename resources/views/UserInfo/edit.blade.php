@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('userinfo.update', $userinfo->Users_id) }}" method="post">
            @csrf
            @method('put')
            <div class="my-3">
                <label for="id-input-id" class="form-label">ID</label>
                <input type="text" class="form-control" id="id-input-id" aria-describedby="id-help-id"
                    value="{{ $userinfo->Users_id }}" disabled>
                <div id="id-help-id" class="form-text">Não é possível atualizar o ID.</div>
            </div>
            <div class="my-3">
                <label for="id-input-profileImg" class="form-label">profileImg</label>
                <input name="profileImg" type="text" class="form-control" id="id-input-profileImg"
                    placeholder="Digite o profileImg" value="{{ $userinfo->profileImg }}">
            </div>
            <div class="my-3">
                <label for="id-input-status" class="form-label">status</label>
                <input name="status" type="text" class="form-control" id="id-input-status"
                    placeholder="Digite o status" value="{{ $userinfo->status }}">
            </div>
            <div class="my-3">
                <label for="id-input-dataNasc" class="form-label">dataNasc</label>
                <input name="dataNasc" type="text" class="form-control" id="id-input-dataNasc"
                    placeholder="Digite o dataNasc" value="{{ $userinfo->dataNasc }}">
            </div>
            <div class="my-3">
                <label for="id-input-genero" class="form-label">genero</label>
                <input name="genero" type="text" class="form-control" id="id-input-genero"
                    placeholder="Digite o genero" value="{{ $userinfo->genero }}">
            </div>
            <div class="my-3">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{ route('userinfo.show', $userinfo->Users_id) }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>
@endsection
