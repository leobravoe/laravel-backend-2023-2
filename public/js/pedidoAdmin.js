$(document).ready(function () {
    function updatePedido() {
        $.ajax({
            type: "GET",
            url: '/pedido/admin/getPedidos',
            data: null,
            dataType: "json",
            success: function (response) {
                pedidosAdmin = response.return;
                // console.log(pedidosAdmin);

                showPedidosAdmin(pedidosAdmin);
               
            },
            error: function (error) {
                console.log(error);
            }

        });
    }

   updatePedido();
  
    function showPedidosAdmin() {
        const mostarPedido = $("#pedido-admin");
        pedidosAdmin.forEach(pedidos => {
            switch (pedidos.status) {
                case "A":
                    mostarPedido.append(`
                    <button value="${pedidos.id}" class="btn-pedido list-group-item text-center list-group-item-action" style=" height: 3rem">Pedido ${pedidos.id}</button>
                    `)
                    break;
                case "F":
                    mostarPedido.append(`
                    <button value="${pedidos.id}"  class="text-center btn-pedido list-group-item list-group-item-action list-group-item-success" style=" height: 3rem">Pedido ${pedidos.id}</button>
                    `)
                    break;
                case "R":
                    mostarPedido.append(`
                    <button value="${pedidos.id}"  class=" text-center btn-pedido list-group-item list-group-item-action list-group-item-warning"style=" height: 3rem">Pedido ${pedidos.id}</button>
                    `)
                    break;
                case "C":
                    mostarPedido.append(`
                    <button value="${pedidos.id}"  class=" text-center btn-pedido list-group-item list-group-item-action list-group-item-danger"style=" height: 3rem">Pedido ${pedidos.id}</button>
                    `)
                    break;
                case "E":
                    mostarPedido.append(`
                    <button value="${pedidos.id}"  class=" text-center btn-pedido list-group-item list-group-item-action list-group-item-primary"style=" height: 3rem">Pedido ${pedidos.id}</button>
                    `)
                    break;
            }
        });
        $(".btn-pedido").click(dadosDoPedido);


    }

    function dadosDoPedido() {
        let idPedidoAdmin = $(this).val();
        $.ajax({
            type: "GET",
            url: `/pedido/admin/${idPedidoAdmin}`,
            data: null,
            dataType: "json",
            success: function (response) {
                pedidosAdmin = response.return;
                showPedidosMeio(pedidosAdmin);
                console.log(pedidosAdmin);
                atribuirStatus(idPedidoAdmin);
                
            },
            error: function (error) {
                console.log(error);
            }
        });
    }


    function showPedidosMeio() {
        $('.pedidos-meio, .number-pedido').html("");
        const listarPedido = $(".pedidos-meio");
        const numeroPedido = $(".number-pedido");

        if (pedidosAdmin.length > 0) {
            numeroPedido.append(`<h4 class="text-center ml-100">Pedido ${pedidosAdmin[0].pedidos_id}</h4>`);
        }
        let valorTotal = 0
        pedidosAdmin.forEach(listaDosPedidos => {
            const valorPedidos = listaDosPedidos.quantidade * listaDosPedidos.preco;
            valorTotal += valorPedidos;
            listarPedido.append(`
                    <tr class="w-100 border-bottom ">
                        <td class="text-middle h-50 d-flex justify-content-center align-middle  w-100">
                            <p class="w-100 d-inline-block pl-1 align-middle "
                                style="margin: 0px; margin-left: 10px">${listaDosPedidos.descricao} - ${listaDosPedidos.nome} - ${listaDosPedidos.quantidade}</p>
                            <button value="${listaDosPedidos.pedidos_id}" class="border-0 bg-transparent "style="margin-right: 10px">
                                <i class="fa-solid fa-pencil" style="color: #5cc0ff;"></i>
                            </button>
                            <button value="${listaDosPedidos.pedidos_id}" class="border-0  bg-transparent" style="margin-right: 10px">
                                <i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                            </button>
                        </td>
                    </tr>
                `);
        });
        $(".valor-pedido").text(valorTotal.toFixed(2));
    }
    function atribuirStatus(idPedidoAdmin) {
        $('.btn-status').attr("value", idPedidoAdmin);

        $('.btn-status').off('click').click(function () {
            idDoBotaoClicado = $(this).attr('value');
            statusDoBotao = $(this).attr('status');
            $('#pedido-admin').html("");
            atualizarStatus(idDoBotaoClicado);
            updatePedido();
            // $('.pedidos-meio, .number-pedido').html("");
        })
        

    }

    function atualizarStatus() {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: `/pedido/admin/status/${idDoBotaoClicado}`,
            data: {
                statusDoBotao: statusDoBotao,
                idDoBotaoClicado: idDoBotaoClicado,
                _token: csrfToken,
            },
            dataType: "json",
            success: function (response) {
                statusPedido = response.return;
                console.log(statusPedido);
               
               
                

            },
            error: function (error) {
                console.log(error);
            }
        });
    }
});

