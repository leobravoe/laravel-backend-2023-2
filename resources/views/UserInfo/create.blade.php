@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Se a página for carregada com a variável message e ela não estiver vazia --}}
        @if (isset($message))
            <div class="alert alert-{{ $message[1] }} alert-dismissible fade show" role="alert">
                <span>{{ $message[0] }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{ route('userinfo.store') }}" method="post">
            @csrf
            <div class="my-3">
                <label for="id-input-id" class="form-label">ID</label>
                <input type="text" class="form-control" id="id-input-id" aria-describedby="id-help-id" value="#"
                    disabled>
                <div id="id-help-id" class="form-text">Não é necessário informar o ID para cadastrar um novo dado.</div>
            </div>
            <div class="my-3">
                <label for="id-input-profileImg" class="form-label">profileImg</label>
                <input name="profileImg" type="text" class="form-control" id="id-input-profileImg"
                    placeholder="Digite o profileImg">
            </div>
            <div class="my-3">
                <label for="id-input-dataNasc" class="form-label">dataNasc</label>
                <input name="dataNasc" type="text" class="form-control" id="id-input-dataNasc"
                    placeholder="Digite a data de nascimento YYYY-MM-DD">
            </div>
            <div class="my-3">
                <label for="id-input-genero" class="form-label">genero</label>
                <input name="genero" type="text" class="form-control" id="id-input-genero"
                    placeholder="Digite a descrição">
            </div>
            <div class="my-3">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{ route("home") }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>
@endsection
