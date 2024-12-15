<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Produto;
use App\Models\TipoProduto;

class ProdutoController extends Controller
{

    private $regras = [
        'nome' => 'required|min:1|max:255|regex:/^[a-zA-ZÀ-ÿ0-9\s]+$/u',
        'preco' => 'required|numeric|min:0.01|max:99999999.99|regex:/^[0-9]+(.[0-9][0-9]?)?$/u',
        'ingredientes' => 'required|regex:/^[a-zA-ZÀ-ÿ0-9\s]+$/u',
        'urlImage' => 'required|regex:/^[a-zA-Z0-9\s]+$/u',
    ];

    private $mensagensDeErroValidacao = [
        'nome.regex' => 'O nome deve conter apenas letras, números e espaços.',
        'preco.regex' => 'O nome deve conter apenas letras, números e espaços.',
        'ingredientes.regex' => 'O nome deve conter apenas letras, números e espaços.',
        'urlImage.regex' => 'O nome deve conter apenas letras, números e espaços.'
    ];

    /**
     * Construtor do EndereçoController
     */
    public function __construct()
    {
        $this->middleware('auth:admin'); // Exigindo que a requeição contenha 
                                         // o guard web para acessar os métodos
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // use Illuminate\Support\Facades\Session;
            $message = Session::get('message'); // Essa variável irá existir quando for passada via with em um redirect
            // O resultado do DB select sempre é um array de objetos
            $produtos = DB::select("SELECT Produtos.id, 
                                           Produtos.nome,
                                           Produtos.preco,
                                           Tipo_Produtos.descricao
                                    FROM Produtos
                                    JOIN Tipo_Produtos ON Produtos.Tipo_Produtos_id = Tipo_Produtos.id
                                    ORDER BY Produtos.id");
            //dd($produtos);
            return view("Produto/index")->with("produtos", $produtos)->with("message", $message);
        } catch (\Throwable $th) {
            // Caso algo dê errado
            return view("Produto/index")->with("produtos", [])->with("message", [$th->getMessage(), "danger"]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            // Busco todos os tipos de produto e armazeno em $tipoProdutos
            $tipoProdutos = DB::select("SELECT * FROM Tipo_Produtos");
            // dd($tipoProdutos);
            // Enviar para a view a variável $tipoProdutos
            return view("Produto/create")->with("tipoProdutos", $tipoProdutos);
        } catch (\Throwable $th) {
            // Caso algo dê errado
            return redirect()->route("produto.index")->with("message", [$th->getMessage(), "danger"]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // // use Illuminate\Support\Facades\Validator;
        // $validador = Validator::make( [
        //                                   'nome' => $request->nome,
        //                                   'preco' => $request->preco,
        //                                   'ingredientes' => $request->ingredientes,
        //                                   'urlImage' => $request->urlImage,
        //                               ], 
        //                               $this->regras, 
        //                               $this->mensagensDeErroValidacao
        //                             );

        // if ($validador->fails()) {
        //     // A validação falhou, você pode lidar com os erros aqui
        //     dd($validador->errors());
        //     // Faça algo com os erros, como retornar uma resposta de erro
        // } else {
        //     dd($request->nome);
        // }

        try {
            $produto = new Produto();
            $produto->nome = $request->nome;
            $produto->preco = $request->preco;
            $produto->Tipo_Produtos_id = $request->Tipo_Produtos_id;
            $produto->ingredientes = $request->ingredientes;
            $produto->urlImage = $request->urlImage;
            $produto->save();
            // caso de sucesso (Quando tudo da certo)
            return redirect()->route("produto.index")->with("message", ["Produto cadastrado com sucesso", "success"]);
        } catch (\Throwable $th) {
            // Caso algo dê errado
            return redirect()->route("produto.index")->with("message", [$th->getMessage(), "danger"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // Toda consulta utilizando o DB::select resulta em um array
            // Essa consulta resulta nos possível resultados: [] ou [0:obj]
            $produtos = DB::select("SELECT Produtos.*, 
                                           Tipo_Produtos.descricao 
                                    FROM Produtos
                                    JOIN Tipo_Produtos ON Produtos.Tipo_Produtos_id = Tipo_Produtos.id
                                    WHERE Produtos.id = ?", [$id]);
            // Verifica se no array tem apenas uma posição
            // dd($produtos);
            if (count($produtos) == 1) {
                // dd($produtos[0]);
                // Mando o objeto da posição 0 para a view
                return view("Produto/show")->with("produto", $produtos[0]);
            }
            // O produto não foi encontrado
            return redirect()->route("produto.index")->with("message", ["Produto não encontrado", "warning"]);
        } catch (\Throwable $th) {
            // Caso algo dê errado
            return redirect()->route("produto.index")->with("message", [$th->getMessage(), "danger"]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * Mostra o formulário para editar um produto específico.
     */
    public function edit(string $id)
    {
        try {
            // Retorna um objeto do tipo model, ou null quando não é encontrado
            $produto = Produto::find($id);
            // Lembrar de dar o use no Model
            // use App\Models\TipoProduto;
            $tipoProdutos = TipoProduto::all();
            //dd($tipoProdutos);
            if (isset($produto)) {
                return view("Produto/edit")->with("produto", $produto)->with("tipoProdutos", $tipoProdutos);
            }
            // O produto não foi encontrado
            return redirect()->route("produto.index")->with("message", ["Produto não encontrado", "warning"]);
        } catch (\Throwable $th) {
            // Caso algo dê errado
            return redirect()->route("produto.index")->with("message", [$th->getMessage(), "danger"]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // O método find retorna um MODEL ou null (quando n encontra)
            $produto = Produto::find($id);
            //dd($produto);
            if (isset($produto)) {
                $produto->nome = $request->nome;
                $produto->preco = $request->preco;
                $produto->Tipo_Produtos_id = $request->Tipo_Produtos_id;
                $produto->ingredientes = $request->ingredientes;
                $produto->urlImage = $request->urlImage;
                $produto->update();
                return redirect()->route("produto.index")->with("message", ["Produto atualizado com sucesso", "success"]);
            }
            // O produto não foi encontrado
            return redirect()->route("produto.index")->with("message", ["Produto não encontrado", "warning"]);
        } catch (\Throwable $th) {
            return redirect()->route("produto.index")->with("message", [$th->getMessage(), "danger"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // O método find retorna um MODEL ou null (quando n encontra)
            $produto = Produto::find($id);
            //dd($produto);
            if (isset($produto)) {
                $produto->delete();
                return redirect()->route("produto.index")->with("message", ["Produto removido com sucesso", "success"]);
            }
            return redirect()->route("produto.index")->with("message", ["Produto não encontrado", "warning"]);
        } catch (\Throwable $th) {
            return redirect()->route("produto.index")->with("message", [$th->getMessage(), "danger"]);
        }
    }
}
