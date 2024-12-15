@extends('layouts.app')

@section('content')
    <script src="{{ asset('js/pedidoAdmin.js') }}"></script>
    <div class="col-md-12 container">
        <div class="row">
            <div class="list-group col-md-3 my-3 overflow-auto" style="height: 350px">
                <a href="{{ url('/admin') }}"class="btn btn-primary w-100 mb-1" style="height:auto; color: black">Voltar</a>
                <div id="pedido-admin">
                </div>
            </div>
            <div class="col-md-6">
                <div id="" class="col-md-12 aling-center">
                    <div class="number-pedido">
                        <h4 class="ml-100 text-center"></h4>
                    </div>
                    <div class="col-md-12 w-100 m-0 rounded border p-0" style="height: 275px">
                        <table class="col-12 w-100 container">
                            <tbody class="pedidos-meio">
                            </tbody>
                        </table>

                    </div>
                    <div class="input-group mt-3">
                        <label class="form-control">Valor total dos pedidos</label>

                        <div class="input-group-append">
                            <span class="input-group-text rounded-0"style="background-color: #8080805c">R$:</span>
                        </div>
                        <div class="input-group-append rounded-end">

                            <span class="valor-pedido input-group-text rounded-0" style="background-color: #8080805c; border-bottom-right-radius: 0.375rem !important; border-top-right-radius: 0.375rem !important;">0.00</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 w-25">
                <div class="col-md-3 w-100">
                    <select id="" class="w-100" style="margin-bottom: 10px" name="Tipo Produtos">
                        <option value="">Pizza</option>
                    </select>
                    <select id="" class="w-100" name="Produtos" style="margin-bottom: 10px">
                        <option value="">Pepperoni</option>
                    </select>
                    <input type="number" class="w-100 text-end" style="margin-bottom: 10px">
                    <button class="btn btn-secondary w-100" style="margin-bottom: 10px">Adicionar</button>
                    <select id="" class="w-100" name="">
                        <option value="">RUA A</option>
                    </select>
                </div>
                <div class="col-md-3 w-100 float-right mt-3">
                    <button value="" status="R" class="btn btn-warning w-100 btn-status p-1" style="margin-bottom: 10px" style="color: black">Comfirmar
                        Pedido</button>
                    <button value="" status='E' class="btn btn-primary w-100 btn-status p-1" style="margin-bottom: 10px">Imprimir
                        Comanda</button>
                    <button value="" status='C' class="btn btn-danger w-100 btn-status p-1" style="margin-bottom: 10px">Cancelar
                        Pedido</button>
                    <button value="" status="F" class="btn btn-success w-100 btn-status p-1" style="margin-bottom: 10px">Finalizar
                        Pedido</button>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
