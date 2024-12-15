@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a class="btn btn-primary" href="{{route("endereco.index")}}">Gerenciar Enderecos</a>
                    <a class="btn btn-primary" href="{{route("pedidousario.index")}}">Gerenciar Pedidos</a>
                    <a class="btn btn-primary" href="{{route("userinfo.index")}}">Gerenciar Informações Adicionais</a>
                    <a class="btn btn-primary" href="/">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
