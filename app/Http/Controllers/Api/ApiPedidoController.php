<?php
namespace App\Http\Controllers\Api;
use App\Models\Pedido;
use App\Http\Controllers\Controller;

class ApiPedidoController extends Controller
{
    public function findAll()
    {
        return response()->json([Pedido::all()]);
    }

    public function findOne($id)
    {
        return response()->json([Pedido::find($id)]);
    }
}
