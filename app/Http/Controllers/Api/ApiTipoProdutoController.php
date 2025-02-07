<?php
namespace App\Http\Controllers\Api;
use App\Models\TipoProduto;
use App\Http\Controllers\Controller;

class ApiTipoProdutoController extends Controller
{
    public function findAll()
    {
        return response()->json([TipoProduto::all()]);
    }

    public function findOne($id)
    {
        return response()->json([TipoProduto::find($id)]);
    }
}
