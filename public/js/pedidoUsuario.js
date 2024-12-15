$(document).ready(function () {
    let vetorProdutosAdicionados = [];

    function groupBy(arr, property) {
        return arr.reduce(function (anterior, atual) {
            if (!anterior[atual[property]]) {
                anterior[atual[property]] = [];
            }
            anterior[atual[property]].push(atual);
            return anterior;
        }, []);
    }
    const selectFiltroTipo = $("#id-select-filtro-tipo");
    selectFiltroTipo.change(function () {
        updateProdutos();
    });
    function updateProdutos() {
        // Pego o value do <option> selecionado no <select>
        const tipoProdutoId = selectFiltroTipo.val();
        // console.log(tipoProdutoId);
        $.ajax({
            type: "GET",
            url: `/pedido/usuario/getprodutos/${tipoProdutoId}`,
            data: null,
            dataType: "json",
            success: function (response) {
                // response.return é um array
                //console.log(response.return);
                produtos_group = groupBy(response.return, "Tipo_Produtos_id");
                console.log(produtos_group);
                showUpdatedProdutos(produtos_group);
                const arrayBtnAddProduto = $(".btn-add-produto");
                //console.log(arrayBtnAddProduto);
                arrayBtnAddProduto.click(addProdutoNoPedido);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }
    function addProdutoNoPedido() {
        // Pego os atributos escondidos dentro do botão que foi clicado
        const idProduto = $(this).attr("value");
        const idTipoProduto = $(this).attr("value-tipo");
        const quant = $(`#id-quant-produto-${idProduto}`).val();
        // console.log(quant);

        // Procura um objeto dentro do array produtos_group utilizando as variáveis idProduto e idTipoProduto
        const produto = produtos_group[idTipoProduto].find(function (obj) {
            return obj.id == idProduto;
        });
        // Adiciono uma propriedade nova
        produto.quant = quant;

        if (quant > 0) {
            vetorProdutosAdicionados[idProduto] = produto;
            console.log(vetorProdutosAdicionados);
            showProdutosAdicionadosNoPedido();
        }
    }

    function showProdutosAdicionadosNoPedido() {
        const tbodyProdutosNoPedido = $("#id-tbody-itens-pedido");
        tbodyProdutosNoPedido.html("");
        vetorProdutosAdicionados.forEach(produto => {
            if (produto != null) {
                tbodyProdutosNoPedido.append(`
                                            <tr>
                                                <td>
                                                    ${produto.descricao} ${produto.nome}
                                                </td>
                                                <td>
                                                    ${produto.quant}
                                                </td>
                                                <td>
                                                    R$ ${(produto.preco * produto.quant).toFixed(2)}
                                                </td>
                                                <td>
                                                    <a value="${produto.id}" class="btn btn-secondary btn-editar-tabela-produtos-adicionados" data-bs-toggle="modal" data-bs-target="#id-edit-modal">Editar</a>
                                                    <a value="${produto.id}" class="btn btn-danger btn-remover-tabela-produtos-adicionados">Remover</a>
                                                </td>
                                            </tr>
                `);
            }
        });
        $(".btn-editar-tabela-produtos-adicionados").click(function () {
            const idProduto = $(this).attr("value");
            console.log(vetorProdutosAdicionados);
            $("#id-modal-img-produto").attr("src", vetorProdutosAdicionados[idProduto].urlImage);
            $("#id-modal-nome-produto").html(vetorProdutosAdicionados[idProduto].nome);
            $("#id-modal-ingredientes-produto").html(vetorProdutosAdicionados[idProduto].ingredientes);
            $("#id-modal-preco-produto").attr("value", vetorProdutosAdicionados[idProduto].preco);
            $("#id-modal-quant-produto").val(vetorProdutosAdicionados[idProduto].quant);
            $("#id-modal-btn-atualizar-produto").attr("value", idProduto);
        });
        $(".btn-remover-tabela-produtos-adicionados").click(function () {
            const idProduto = $(this).attr("value");
            console.log("tentando remover: ", idProduto);
            vetorProdutosAdicionados[idProduto] = null;
            showProdutosAdicionadosNoPedido(); // Roda a função para fazer o repaint
        });
        $("#id-modal-btn-atualizar-produto").click(function () {
            const idProduto = $(this).attr("value");
            vetorProdutosAdicionados[idProduto].quant = $("#id-modal-quant-produto").val();
            showProdutosAdicionadosNoPedido();
        });
        $('html, body').animate({
            scrollTop: tbodyProdutosNoPedido.offset().top
        });
    }

    function showUpdatedProdutos(produtos_group) {
        const divListProdutos = $("#id-div-lista-produtos");
        divListProdutos.html("");
        produtos_group.forEach(produtos_tipo => {
            // Imprimir inforções do tipo
            divListProdutos.append(`
                <div class="my-4 border border-dark">
                    <div class="m-4">
                        <h4 class="d-inline">${produtos_tipo[0].descricao}</h4>
                        <select class="float-end">
                            <option value="">Ordem do sistema</option>
                            <option value="">Menor para maior</option>
                            <option value="">Maior para menor</option>
                        </select>
                    </div>
                    <div class="my-4 produto">
                    </div>
                </div>
            `);
            produtos_tipo.forEach(produto => {
                // Imprimir as informação da variável produto
                $(".my-4.produto:last").append(`
                    <div class="row m-3 border border-dark">
                        <div class="col-md-3 my-auto">
                            <img class="w-100 h-100" src="${produto.urlImage}">
                        </div>
                        <div class="col-md-6 my-auto">
                            <h5>${produto.nome}</h5>
                            <h6>Ingredientes:</h6>
                            <p>${produto.ingredientes}</p>
                        </div>
                        <div class="col-md-3 my-auto">
                            <div class="my-3">
                                <input type="text" class="form-control" value="R$ ${produto.preco}" readonly>
                            </div>
                            <div class="my-3">
                                <input type="number" class="form-control" id="id-quant-produto-${produto.id}" value="1">
                            </div>
                            <div class="my-3">
                                <a class="btn btn-primary w-100 btn-add-produto" value="${produto.id}" value-tipo="${produto.Tipo_Produtos_id}">Adicionar Produto</a>
                            </div>
                        </div>
                    </div>
                `);
            });
        });
    }

    $("#id-button-enviar-pedido").click(sendVetorProdutosAdicionados);

    function sendVetorProdutosAdicionados(){
        const csrfToken = $('meta[name="csrf-token"]').attr('content'); // Obtém o token CSRF
        const idEndereco = $("#id-select-endereco").val();
        $.ajax({
            type: "POST",
            url: `/pedido/usuario`,
            data: {
                vetorProdutosAdicionados: vetorProdutosAdicionados,
                idEndereco: idEndereco,
                _token: csrfToken
            },
            dataType: "json",
            success: function (response) {
                window.location.href= "/home";
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    // Faz a chamada para buscar os arquivos pela primeira vez
    updateProdutos();
});

