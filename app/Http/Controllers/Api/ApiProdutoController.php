<?php
namespace App\Http\Controllers\Api;
use App\Models\Produto;
use App\Http\Controllers\Controller;

class ApiProdutoController extends Controller
{
    public function findAll()
    {
        return response()->json([Produto::all()]);
    }

    public function findOne($id)
    {
        return response()->json([Produto::find($id)]);
    }
}
