<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Endereco;

class EnderecoController extends Controller
{
    /**
     * Construtor do EndereçoController
     */
    public function __construct()
    {
        $this->middleware('auth:web'); // Exigindo que a requeição contenha 
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
            // Pegando o id do usuário que está logado
            // use Illuminate\Support\Facades\Auth;
            $usersId = Auth::user()->id;
            // O resultado do DB select sempre é um array de objetos
            $enderecos = DB::select("SELECT *
                                     FROM Enderecos
                                     WHERE Enderecos.Users_id = ?
                                     ORDER BY Enderecos.id", [$usersId]);
            return view("Endereco/index")->with("enderecos", $enderecos)->with("message", $message);
        } catch (\Throwable $th) {
            // Caso algo dê errado
            return view("Endereco/index")->with("enderecos", [])->with("message", [$th->getMessage(), "danger"]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view("Endereco/create");
        } catch (\Throwable $th) {
            // Caso algo dê errado
            return redirect()->route("endereco.index")->with("message", [$th->getMessage(), "danger"]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Pegando o id do usuário que está logado
            // use Illuminate\Support\Facades\Auth;
            $usersId = Auth::user()->id;

            $endereco = new Endereco();
            $endereco->Users_id = $usersId;
            $endereco->bairro = $request->bairro;
            $endereco->logradouro = $request->logradouro;
            $endereco->numero = $request->numero;
            $endereco->complemento = $request->complemento;
            $endereco->save();
            return redirect()->route("endereco.index")->with("message", ["Endereco cadastrado com sucesso", "success"]);
        } catch (\Throwable $th) {
            return redirect()->route("endereco.index")->with("message", [$th->getMessage, "danger"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // Pegando o id do usuário que está logado
            // use Illuminate\Support\Facades\Auth;
            $usersId = Auth::user()->id;
            $enderecos = DB::select("SELECT *
                                     FROM Enderecos
                                     WHERE Enderecos.id = ? AND
                                           Enderecos.Users_id = ?", [$id, $usersId]);
            if (count($enderecos) == 1) {
                return view("Endereco/show")->with("endereco", $enderecos[0]);
            }
            // O produto não foi encontrado
            return redirect()->route("endereco.index")->with("message", ["Endereco não encontrado", "warning"]);
        } catch (\Throwable $th) {
            // Caso algo dê errado
            return redirect()->route("endereco.index")->with("message", [$th->getMessage(), "danger"]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $usersId = Auth::user()->id;
            // Retorna um objeto do tipo model, ou null quando não é encontrado
            $endereco = Endereco::where('id', $id)->where('Users_id', $usersId)->first();
            //dd($tipoProdutos);
            if (isset($endereco)) {
                return view("Endereco/edit")->with("endereco", $endereco);
            }
            // O produto não foi encontrado
            return redirect()->route("endereco.index")->with("message", ["Endereco não encontrado", "warning"]);
        } catch (\Throwable $th) {
            // Caso algo dê errado
            return redirect()->route("endereco.index")->with("message", [$th->getMessage(), "danger"]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $usersId = Auth::user()->id;
            // O método find retorna um MODEL ou null (quando n encontra)
            $endereco = Endereco::where('id', $id)->where('Users_id', $usersId)->first();
            //dd($produto);
            if (isset($endereco)) {
                $endereco->bairro = $request->bairro;
                $endereco->logradouro = $request->logradouro;
                $endereco->numero = $request->numero;
                $endereco->complemento = $request->complemento;
                $endereco->update();
                return redirect()->route("endereco.index")->with("message", ["Endereco atualizado com sucesso", "success"]);
            }
            // O produto não foi encontrado
            return redirect()->route("endereco.index")->with("message", ["Endereco não encontrado", "warning"]);
        } catch (\Throwable $th) {
            return redirect()->route("endereco.index")->with("message", [$th->getMessage(), "danger"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $usersId = Auth::user()->id;
            // O método find retorna um MODEL ou null (quando n encontra)
            $endereco = Endereco::where('id', $id)->where('Users_id', $usersId)->first();
            //dd($produto);
            if (isset($endereco)) {
                $endereco->delete();
                return redirect()->route("endereco.index")->with("message", ["Endereco removido com sucesso", "success"]);
            }
            return redirect()->route("endereco.index")->with("message", ["Endereco não encontrado", "warning"]);
        } catch (\Throwable $th) {
            return redirect()->route("endereco.index")->with("message", [$th->getMessage(), "danger"]);
        }
    }
}
