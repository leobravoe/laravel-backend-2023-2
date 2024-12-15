@extends('layouts.app')

@section('content')
    <script src="{{ asset('js/pedidoUsuario.js') }}"></script>
    <div class="container">
        {{-- Parte superior --}}
        <div>
            <h1 class="text-center">Faça seu Pedido</h1>
            <div class="row">
                <div class="col-md-6 my-1">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Filtro de nome de produto">
                        <button id="id-button-busca" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <select id="id-select-filtro-tipo" class="form-select">
                        <option value="0">Tudo</option>
                        <option value="1">Pizza</option>
                        <option value="2">Suco</option>
                        <option value="3">Cerveja</option>
                    </select>
                </div>
            </div>
        </div>
        {{-- Parte meio --}}
        <div id="id-div-lista-produtos"></div>
        {{-- Parte inferior --}}
        <div class="my-4 border border-dark">
            <div class="m-3">
                <h4>Itens do Pedido</h4>
            </div>
            <div class="m-3">
                <table class="table text-center">
                    <tbody id="id-tbody-itens-pedido"></tbody>
                </table>
            </div>
            <div class="m-3">
                <select class="form-select" id="id-select-endereco">
                    <option value="1">Rua Pedro II, 111, Apto. 303.</option>
                    <option value="2">Rua das Tabocas, 111, Carverna numero 3.</option>
                    <option value="0">Buscar no local</option>
                </select>
            </div>
            <div class="m-3">
                <a id="id-button-enviar-pedido" class="btn btn-primary w-100">Próximo</a>
            </div>
        </div>
    </div>

    <!-- Modal de editar produtos no carrinho de compra -->
    <div class="modal fade" id="id-edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row m-3 border border-dark">
                        <div class="col-md-3 p-3 my-auto">
                            <img id="id-modal-img-produto" class="w-100" src="" alt="" srcset="">
                        </div>
                        <div class="col-md-6 my-auto">
                            <h5 id="id-modal-nome-produto" class="my-3">PRODUTO NOME</h5>
                            <h6 class="my-2">Ingredientes:</h6>
                            <p id="id-modal-ingredientes-produto">PRODUTO INGREDIENTES</p>
                        </div>
                        <div class="col-md-3 my-auto">
                            <div class="my-3">
                                <label for="id-modal-preco-produto">Preço Unitário</label>
                                <input id="id-modal-preco-produto" type="text" class="form-control" placeholder="Preço"
                                    value="R$ PRODUTO PREÇO" readonly>
                            </div>
                            <div class="my-3">
                                <input type="number" class="form-control" id="id-modal-quant-produto" value="1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="id-modal-btn-atualizar-produto" class="btn btn-secondary"  data-bs-dismiss="modal">Atualizar</a>
                </div>
            </div>
        </div>
    </div>
    
@endsection
