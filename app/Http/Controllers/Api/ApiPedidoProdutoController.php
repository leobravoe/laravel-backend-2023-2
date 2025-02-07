<?php
namespace App\Http\Controllers\Api;
use App\Models\PedidoProduto;
use App\Http\Controllers\Controller;

class ApiPedidoProdutoController extends Controller
{
    public function findAll()
    {
        return response()->json([PedidoProduto::all()]);
    }

    public function findOne($pedido, $produto)
    {
        return response()->json([PedidoProduto::where('Pedidos_id', $pedido)->where('Produtos_id', $produto)->first()]);
    }

    public function findPedido($id)
    {
        return response()->json([PedidoProduto::where('Pedidos_id', $id)->get()]);
    }

    public function findProduto($id)
    {
        return response()->json([PedidoProduto::where('Produtos_id', $id)->get()]);
    }
}
