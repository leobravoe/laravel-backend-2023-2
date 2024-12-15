@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a class="btn btn-primary" href="{{route('pedidoadmin.index')}}">Gerenciar Pedidos</a>
                    <a class="btn btn-primary" href="{{route("produto.index")}}">Gerenciar Produtos</a>
                    <a class="btn btn-primary" href="{{route("tipoproduto.index")}}">Gerenciar Tipos de Produto</a>
                    <a class="btn btn-primary" href="{{url("/")}}">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
