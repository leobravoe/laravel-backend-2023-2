@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Se a página for carregada com a variável message e ela não estiver vazia --}}
        @if ( isset($message) )
            <div class="alert alert-{{$message[1]}} alert-dismissible fade show" role="alert">
                <span>{{$message[0]}}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <a href="{{ route('produto.create') }}" class="btn btn-primary">Criar Produto</a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Voltar</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)
                    <tr>
                        <th>{{ $produto->id }}</th>
                        <td>{{ $produto->nome }}</td>
                        <td>{{ $produto->preco }}</td>
                        <td>{{ $produto->descricao }}</td>
                        <td>
                            <a href="{{ route('produto.show', $produto->id) }}" class="btn btn-primary">Mostrar</a>
                            <a href="{{ route('produto.edit', $produto->id) }}" class="btn btn-secondary">Editar</a>
                            <a href="#" class="btn btn-danger btnRemover" data-bs-toggle="modal"
                                data-bs-target="#id-modal-destroy" value="{{ route('produto.destroy', $produto->id) }}">
                                Remover
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
