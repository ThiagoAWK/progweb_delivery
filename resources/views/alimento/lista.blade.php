@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Lista de Alimentos
                        <a href="{{ url('alimento/create') }}" class="btn btn-success btn-sm float-end">
                            Novo Alimento
                        </a>
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
                                        <td>
                                            <a href="{{ url('alimento/' . $alimento->id) }}" class="btn btn-primary btn-sm">
                                                Editar
                                            </a>
                                            {!! Form::open(['method' => 'DELETE', 'url' => 'alimento/' . $alimento->id, 'style' => 'display:inline']) !!}
                                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            Não há itens para listar!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="pagination justify-content-center">
                            {{ $alimentos->links() }}
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('alimento/report') }}" target="_blank"
                            class="btn btn-sm btn-warning ">
                            Relatório
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection