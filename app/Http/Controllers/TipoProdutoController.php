<?php

namespace App\Http\Controllers;

use App\Models\TipoProduto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TipoProdutoController extends Controller
{
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
            $message = Session::get('message'); // Essa variável irá existir quando for passada via with em um redirect
            $tipoProdutos = DB::select('SELECT * FROM Tipo_Produtos');
            return view("TipoProduto/index")->with("tipoProdutos", $tipoProdutos)->with("message", $message);
        } catch (\Throwable $th) {
            return view("TipoProduto/index")->with("tipoProdutos", $tipoProdutos)->with("message", [$th->getMessage(), "danger"]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("TipoProduto/create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $tipoProduto = new TipoProduto();
            $tipoProduto->descricao = $request->descricao;
            $tipoProduto->save();
            return redirect()->route("tipoproduto.index")->with("message", ["TipoProduto cadastrado com sucesso", "success"]);
        } catch (\Throwable $th) {
            return redirect()->route("tipoproduto.index")->with("message", [$th->getMessage(), "danger"]);
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
            $tipoProdutos = DB::select("SELECT *
                                        FROM Tipo_Produtos
                                        WHERE Tipo_Produtos.id = ?", [$id]);
            // Verifica se no array tem apenas uma posição
            // dd($tipoProdutos);
            if (count($tipoProdutos) == 1) {
                // Mando o objeto da posição 0 para a view
                return view("TipoProduto/show")->with("tipoProduto", $tipoProdutos[0]);
            }
            return redirect()->route("tipoproduto.index")->with("message", ["TipoProduto não encontrado", "warning"]);
        } catch (\Throwable $th) {
            return redirect()->route("tipoproduto.index")->with("message", [$th->getMessage(), "danger"]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $tipoProduto = TipoProduto::find($id);
            // dd($tipoProduto);
            // Testo para ver se $tipoProduto é diferente de null
            if (isset($tipoProduto)) {
                return view("TipoProduto/edit")->with("tipoProduto", $tipoProduto);
            }
            return redirect()->route("tipoproduto.index")->with("message", ["TipoProduto não encontrado", "warning"]);
        } catch (\Throwable $th) {
            return redirect()->route("tipoproduto.index")->with("message", [$th->getMessage(), "danger"]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $tipoProduto = TipoProduto::find($id);
            if (isset($tipoProduto)) {
                $tipoProduto->descricao = $request->descricao;
                $tipoProduto->update();
                return redirect()->route("tipoproduto.index")->with("message", ["TipoProduto atualizado com sucesso", "success"]);
            }
            return redirect()->route("tipoproduto.index")->with("message", ["TipoProduto não encontrado", "warning"]);
        } catch (\Throwable $th) {
            return redirect()->route("tipoproduto.index")->with("message", [$th->getMessage(), "danger"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // O método find retorna um MODEL ou null (quando n encontra)
            $tipoProduto = TipoProduto::find($id);
            //dd($tipoProduto);
            if (isset($tipoProduto)) {
                $tipoProduto->delete();
                return redirect()->route("tipoproduto.index")->with("message", ["TipoProduto excluido com sucesso", "success"]);
            }
            return redirect()->route("tipoproduto.index")->with("message", ["TipoProduto não encontrado", "warning"]);
        } catch (\Throwable $th) {
            return redirect()->route("tipoproduto.index")->with("message", [$th->getMessage(), "danger"]);
        }
    }
}
