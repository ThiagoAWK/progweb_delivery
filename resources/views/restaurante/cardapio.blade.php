@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Cardápio {{ $restaurante->nome }}
                    </div>
                    <div class="card-body">
                        @if(Session::has('mensagem_sucesso'))
                            <div class="alert alert-success">
                                {{ Session::get('mensagem_sucesso') }}
                            </div>
                        @endif
                        <table class="table table-sm table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Preço</th>
                                    <th>Restaurante</th>
                                    <th>Categoria</th>
                                    <th>Carrinho</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($alimentos as $alimento)
                                    <tr>
                                        <td>{{ $alimento->id }}</td>
                                        <td>{{ $alimento->nome }}</td>
                                        <td>{{ $alimento->desc }}</td>
                                        <td>R$ {{ $alimento->preco }}</td>
                                        <td>{{ $alimento->restaurante->nome }}</td>
                                        <td>{{ $alimento->categoria->nome }}</td>
                                        </td>
                                        <td>
                                            <form action="{{ route('carrinho.adicionar') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="alimento_id" value="{{ $alimento->id }}">
                                                <input type="number" name="quantidade" value="1" min="1">
                                                <button type="submit" class="btn btn-primary">Adicionar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            Não há itens para listar!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <a href="{{ route('restaurante.listar') }}" class="btn btn-primary">Continuar Comprando</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
