<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;
use App\Models\PedidoProduto;

class PedidoUsuarioController extends Controller {

    /**
     * Construtor do PedidoUsuarioController
     */
    public function __construct() {
        $this->middleware('auth:web');   // Exigindo que a requeição contenha 
        // o guard web para acessar os métodos
    }

    /**
     * Método para caregar a página inicial de PedidoUsuario
     */
    public function index() {
        return view("PedidoUsuario/index");
    }

    public function getProdutos(int $id) {
        if($id < 1) {
            // lembrar de dar o use Illuminate\Support\Facades\DB;
            // O retorno de DB::select sempre é um array
            $produtos = DB::select("SELECT Produtos.*, 
                                           Tipo_Produtos.descricao 
                                    FROM Produtos
                                    JOIN Tipo_Produtos on Produtos.Tipo_Produtos_id = Tipo_Produtos.id
                                    ORDER BY Produtos.id");
        } else {
            // O retorno de DB::select sempre é um array
            $produtos = DB::select("SELECT Produtos.*, 
                                           Tipo_Produtos.descricao 
                                    FROM Produtos
                                    JOIN Tipo_Produtos on Produtos.Tipo_Produtos_id = Tipo_Produtos.id
                                    WHERE Tipo_Produtos.id = ?
                                    ORDER BY Produtos.id", [$id]);
        }
        $response["success"] = true;
        $response["message"] = "Consulta de tipo realizada com sucesso.";
        $response["return"] = $produtos;
        return response()->json($response, 201);
    }

    public function store(Request $request) {
        // Pedo o id do usuário logado
        // Lembrar de dar o use Illuminate\Support\Facades\Auth;
        $usersId = Auth::user()->id;

        // Faz a validação do idEndereco encaminhado pelo front-end
        if($request->idEndereco == 0) {
            $idEndereco = null;
        } else {
            // Lembrar de dar o use App\Models\Endereco;
            // Busca o endereço no banco caso ele pertença ao usuário logado
            $endereco = Endereco::where('id', $request->idEndereco)->where('Users_id', $usersId)->first();
            if(!isset($endereco)) {
                return response()->json("Endereco não encontrado", 404);
            }
            $idEndereco = $endereco->id;
        }

        // Lembrar de dar o use App\Models\Pedido;
        // php artisan make:model Pedido
        $pedido = new Pedido();
        $pedido->status = 'A';
        $pedido->Users_id = $usersId;
        $pedido->Enderecos_id = $idEndereco;
        $pedido->save();

        foreach($request->vetorProdutosAdicionados as $pedidoProdutoRequest) {
            if(isset($pedidoProdutoRequest)) {
                $pedidoProduto = new PedidoProduto();
                $pedidoProduto->Pedidos_id = $pedido->id;
                $pedidoProduto->Produtos_id = $pedidoProdutoRequest['id'];
                $pedidoProduto->quantidade = $pedidoProdutoRequest['quant'];
                $pedidoProduto->save();
            }

        }


        return response()->json("Pedido Criado com sucesso", 201);
    }
}
