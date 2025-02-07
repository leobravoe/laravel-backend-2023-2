<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Produto;
use App\Models\Pedido;
use App\Models\PedidoProduto;

Route::get('/example', function () {
    return response()->json(['message' => 'Hello from Laravel!']);
});

// Chamadas API
Route::get('/pedido', "App\Http\Controllers\Api\ApiPedidoController@findAll")->name("api.pedido.findAll");
Route::get('/pedido/{id}', "App\Http\Controllers\Api\ApiPedidoController@findOne")->name("api.pedido.findOne");

Route::get('/pedidoproduto', "App\Http\Controllers\Api\ApiPedidoProdutoController@findAll")->name("api.pedidoproduto.findAll");
Route::get('/pedidoproduto/pedido/{id}', "App\Http\Controllers\Api\ApiPedidoProdutoController@findPedido")->name("api.pedidoproduto.findPedido");
Route::get('/pedidoproduto/produto/{id}', "App\Http\Controllers\Api\ApiPedidoProdutoController@findProduto")->name("api.pedidoproduto.findProduto");
Route::get('/pedidoproduto/{pedido}/{produto}', "App\Http\Controllers\Api\ApiPedidoProdutoController@findOne")->name("api.pedidoproduto.findOne");

Route::get('/produto', "App\Http\Controllers\Api\ApiProdutoController@findAll")->name("api.produto.findAll");
Route::get('/produto/{id}', "App\Http\Controllers\Api\ApiProdutoController@findOne")->name("api.produto.findOne");

Route::get('/tipoproduto', "App\Http\Controllers\Api\ApiTipoProdutoController@findAll")->name("api.tipoproduto.findAll");
Route::get('/tipoproduto/{id}', "App\Http\Controllers\Api\ApiTipoProdutoController@findOne")->name("api.tipoproduto.findOne");

