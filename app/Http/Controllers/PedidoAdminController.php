<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth:admin'); 
    }
    public function index()
    {
        return view("PedidoAdmin/index");
    }

    public function getPedidos()
    {
        $pedidos = DB::select("SELECT * FROM Pedidos ORDER BY id DESC");
        $response["success"] = true;
        $response["message"] = "Consulta de tipo realizada com sucesso";
        $response["return"] = $pedidos;
        return response()->json($response, 200);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
     // Substitua 1 pelo valor do ID desejado

        $pedidosAdmin = DB::select(
            "SELECT tipo_produtos.descricao, produtos.nome, produtos.preco, pedido_produtos.quantidade, pedido_produtos.Produtos_id, pedido_produtos.pedidos_id
            FROM produtos
            JOIN tipo_produtos ON produtos.Tipo_Produtos_id = tipo_produtos.id
            JOIN pedido_produtos ON produtos.id = pedido_produtos.Produtos_id
            WHERE pedido_produtos.pedidos_id = ?", [$id]
        );
        $response["success"] = true;
        $response["message"] = "Consulta de tipo realizada com sucesso";
        $response["return"] = $pedidosAdmin;
        return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pedido = Pedido::find($id); // Encontra o pedido com base no ID
        
        $valoresPermitidos = ['A', 'F', 'R', 'C', 'E'];

        $novoStatus = $request->input('statusDoBotao');

        if (in_array($novoStatus, $valoresPermitidos)) {
            $pedido->status = $novoStatus;
            $pedido->save();
    
            $response["success"] = true;
            $response["message"] = "Status do pedido atualizado com sucesso";
            $response["return"] = $pedido;
    
            return response()->json($response, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
