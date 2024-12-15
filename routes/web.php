<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tipoproduto', "App\Http\Controllers\TipoProdutoController@index")->name("tipoproduto.index");
Route::get('/tipoproduto/create', "App\Http\Controllers\TipoProdutoController@create")->name("tipoproduto.create");
Route::post('/tipoproduto', "App\Http\Controllers\TipoProdutoController@store")->name("tipoproduto.store");
Route::get('/tipoproduto/{id}', "App\Http\Controllers\TipoProdutoController@show")->name("tipoproduto.show");
Route::get('/tipoproduto/{id}/edit', "App\Http\Controllers\TipoProdutoController@edit")->name("tipoproduto.edit");
Route::put('/tipoproduto/{id}', "App\Http\Controllers\TipoProdutoController@update")->name("tipoproduto.update");
Route::delete('/tipoproduto/{id}', "App\Http\Controllers\TipoProdutoController@destroy")->name("tipoproduto.destroy");

Route::get('/produto', "App\Http\Controllers\ProdutoController@index")->name("produto.index");
Route::get('/produto/create', "App\Http\Controllers\ProdutoController@create")->name("produto.create");
Route::post('/produto', "App\Http\Controllers\ProdutoController@store")->name("produto.store");
Route::get('/produto/{id}', "App\Http\Controllers\ProdutoController@show")->name("produto.show");
Route::get('/produto/{id}/edit', "App\Http\Controllers\ProdutoController@edit")->name("produto.edit");
Route::put('/produto/{id}', "App\Http\Controllers\ProdutoController@update")->name("produto.update");
Route::delete('/produto/{id}', "App\Http\Controllers\ProdutoController@destroy")->name("produto.destroy");

//Route::resource("/endereco", "App\Http\Controllers\EnderecoController");
Route::get('/endereco', "App\Http\Controllers\EnderecoController@index")->name("endereco.index");
Route::get('/endereco/create', "App\Http\Controllers\EnderecoController@create")->name("endereco.create");
Route::post('/endereco', "App\Http\Controllers\EnderecoController@store")->name("endereco.store");
Route::get('/endereco/{id}', "App\Http\Controllers\EnderecoController@show")->name("endereco.show");
Route::get('/endereco/{id}/edit', "App\Http\Controllers\EnderecoController@edit")->name("endereco.edit");
Route::put('/endereco/{id}', "App\Http\Controllers\EnderecoController@update")->name("endereco.update");
Route::delete('/endereco/{id}', "App\Http\Controllers\EnderecoController@destroy")->name("endereco.destroy");

Route::get('/userinfo', "App\Http\Controllers\UserInfoController@index")->name("userinfo.index");
Route::get('/userinfo/create', "App\Http\Controllers\UserInfoController@create")->name("userinfo.create");
Route::post('/userinfo', "App\Http\Controllers\UserInfoController@store")->name("userinfo.store");
Route::get('/userinfo/{id}', "App\Http\Controllers\UserInfoController@show")->name("userinfo.show");
Route::get('/userinfo/{id}/edit', "App\Http\Controllers\UserInfoController@edit")->name("userinfo.edit");
Route::put('/userinfo/{id}', "App\Http\Controllers\UserInfoController@update")->name("userinfo.update");
Route::delete('/userinfo/{id}', "App\Http\Controllers\UserInfoController@destroy")->name("userinfo.destroy");

//use Illuminate\Support\Facades\Auth;
Auth::routes();
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::post('/user/logout', 'App\Http\Controllers\Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function () {
    // Dashboard route
    Route::get('/', 'App\Http\Controllers\AdminController@index')->name('admin.dashboard');

    // Login routes
    Route::get('/login', 'App\Http\Controllers\Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'App\Http\Controllers\Auth\AdminLoginController@login')->name('admin.login.submit');

    // Logout route
    Route::post('/logout', 'App\Http\Controllers\Auth\AdminLoginController@logout')->name('admin.logout');

    // Register routes
    //Route::get('/register', 'App\Http\Controllers\Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
    //Route::post('/register', 'App\Http\Controllers\Auth\AdminRegisterController@register')->name('admin.register.submit');

    // Password reset routes
    Route::get('/password/reset', 'App\Http\Controllers\Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'App\Http\Controllers\Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}', 'App\Http\Controllers\Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'App\Http\Controllers\Auth\AdminResetPasswordController@reset')->name('admin.password.update');
});

Route::get('/pedido/usuario', "App\Http\Controllers\PedidoUsuarioController@index")->name("pedidousario.index");
Route::post('/pedido/usuario', "App\Http\Controllers\PedidoUsuarioController@store")->name("pedidousario.store");
Route::get('/pedido/usuario/getprodutos/{id}', "App\Http\Controllers\PedidoUsuarioController@getProdutos")->name("pedidousuario.getProdutos");

Route::get('/pedido/admin', "App\Http\Controllers\PedidoAdminController@index")->name("pedidoadmin.index");
Route::get('/pedido/admin/getPedidos', "App\Http\Controllers\PedidoAdminController@getPedidos")->name("pedidoadmin.getPedidos");
Route::get('/pedido/admin/{id}', "App\Http\Controllers\PedidoAdminController@show")->name("pedidoadmin.show");
Route::post('/pedido/admin/status/{id}', "App\Http\Controllers\PedidoAdminController@update")->name("pedidoadmin.update");

