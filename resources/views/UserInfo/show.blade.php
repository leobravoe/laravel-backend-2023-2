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
        <a href="{{ route('userinfo.edit', $userinfo->Users_id) }}" class="btn btn-secondary">Editar</a>
        <a href="#" class="btn btn-danger btnRemover" data-bs-toggle="modal" data-bs-target="#id-modal-destroy"
            value="{{ route('userinfo.destroy', $userinfo->Users_id) }}">Remover</a>
        <a href="{{ route("home") }}" class="btn btn-primary">Voltar</a>
        <div class="my-3">
            <label for="id-input-id" class="form-label">ID</label>
            <input type="text" class="form-control" id="id-input-id" aria-describedby="id-help-id"
                value="{{ $userinfo->Users_id }}" disabled>
        </div>
        <div class="my-3">
            <label for="id-input-profileImg" class="form-label">profileImg</label>
            <input name="profileImg" type="text" class="form-control" id="id-input-profileImg"
                placeholder="Digite o profileImg" disabled value="{{ $userinfo->profileImg }}">
        </div>
        <div class="my-3">
            <label for="id-input-status" class="form-label">status</label>
            <input name="status" type="text" class="form-control" id="id-input-status"
                placeholder="Digite o status" disabled value="{{ $userinfo->status }}">
        </div>
        <div class="my-3">
            <label for="id-input-dataNasc" class="form-label">dataNasc</label>
            <input name="dataNasc" type="text" class="form-control" id="id-input-dataNasc"
                placeholder="Digite a data de nascimento YYYY-MM-DD" disabled value="{{ $userinfo->dataNasc }}">
        </div>
        <div class="my-3">
            <label for="id-input-genero" class="form-label">genero</label>
            <input name="genero" type="text" class="form-control" id="id-input-genero" placeholder="Digite a descrição"
                disabled value="{{ $userinfo->genero }}">
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="id-modal-destroy" tabindex="-1" aria-labelledby="destroyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="destroyModalLabel">Remover Recurso</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <p>Deseja realmente remover esse recurso?</p>
                </div>
                <div class="modal-footer">
                    <form id="id-form-modal-botao-remover" action="" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" class="btn btn-danger" value="Confirmar">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Busca todos os elementos que contenham a classe btnRemover
        const arrayBotaoRemover = document.querySelectorAll(".btnRemover");
        const formModalBotaoRemover = document.querySelector("#id-form-modal-botao-remover");
        // console.log(arrayBotaoRemover);
        arrayBotaoRemover.forEach(element => {
            element.addEventListener("click", configuraBotaoRemoverModal);
        });

        function configuraBotaoRemoverModal() {
            const destroyRoute = this.getAttribute("value");
            formModalBotaoRemover.setAttribute("action", destroyRoute);
        }
    </script>
@endsection
