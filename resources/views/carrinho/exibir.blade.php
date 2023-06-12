@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Carrinho de Compras
                    </div>
                    <div class="card-body">
                        @if(Session::has('mensagem_sucesso'))
                            <div class="alert alert-success">
                                {{ Session::get('mensagem_sucesso') }}
                            </div>
                        @endif
                        @if (count($alimentosCarrinho) > 0)
                        <table class="table table-sm table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Restaurante</th>
                                    <th>Alimento</th>
                                    <th>Categoria</th>
                                    <th>Quantidade</th>
                                    <th>Preço</th>
                                    <th>Total</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alimentosCarrinho as $item)
                                    <tr>
                                        <td>{{ $item['alimento']->restaurante->nome }}</td>
                                        <td>{{ $item['alimento']->nome }}</td>
                                        <td>{{ $item['alimento']->categoria->nome }}</td>
                                        <td>{{ $item['quantidade'] }}</td>
                                        <td>R$ {{ $item['alimento']->preco }}</td>
                                        <td>R$ {{ $item['alimento']->preco * $item['quantidade'] }}</td>
                                        <td>
                                            <form action="{{ route('carrinho.remover') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="alimento_id" value="{{ $item['alimento']->id }}">
                                                <button type="submit" class="btn btn-danger btn-sm">Remover</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">
                                            Não há itens para listar!
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <a href="{{ route('restaurante.listar') }}" class="btn btn-primary">Continuar Comprando</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection