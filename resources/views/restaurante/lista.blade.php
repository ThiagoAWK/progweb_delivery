@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Lista de Restaurantes
                        <a href="{{ url('restaurante/create') }}" class="btn btn-success btn-sm float-end">
                            Novo Restaurante
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
                                    <th>Endereço</th>
                                    <th>Telefone</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($restaurantes as $restaurante)
                                    <tr>
                                        <td>{{ $restaurante->id }}</td>
                                        <td>{{ $restaurante->nome }}</td>
                                        <td>{{ $restaurante->endereco }}</td>
                                        <td>{{ $restaurante->fone }}</td>
                                        <td>
                                            <a href="{{ url('restaurante/' . $restaurante->id) }}" class="btn btn-primary btn-sm">
                                                Editar
                                            </a>
                                            {!! Form::open(['method' => 'DELETE', 'url' => 'restaurante/' . $restaurante->id, 'style' => 'display:inline']) !!}
                                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                            {!! Form::close() !!}
                                            <a href="{{ url('restaurante/alimento/' . $restaurante->id) }}" class="btn btn-secondary btn-sm">
                                                Cardápio
                                            </a>
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
                        <div class="pagination justify-content-center">
                            {{ $restaurantes->links() }}
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('restaurante/report') }}" target="_blank"
                            class="btn btn-sm btn-warning ">
                            Relatório
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
