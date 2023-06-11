@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Dados do Categoria
                        <a href="{{ url('categoria') }}" class="btn btn-success btn-sm float-end">
                            Listar Categorias
                        </a>
                    </div>
                    <div class="card-body">
                        @if(Session::has('mensagem_sucesso'))
                            <div class="alert alert-success">
                                {{ Session::get('mensagem_sucesso') }}
                            </div>
                        @endif
                        @if(Session::has('mensagem_erro'))
                            <div class="alert alert-danger">
                                {{ Session::get('mensagem_erro') }}
                            </div>
                        @endif

                        @if(Route::is('categoria.show'))
                            {!! Form::model($categoria,
                                            ['method'=>'PATCH',
                                            'url'=>'categoria/' . $categoria->id]) !!}
                        @else
                            {!! Form::open(['method'=>'POST', 'url'=>'categoria']) !!}
                        @endif
                        {!! Form::label('nome', 'Nome') !!}
                        {!! Form::input('text', 'nome',
                                        null,
                                        ['class'=>'form-control',
                                         'placeholder'=>'Nome',
                                         'required',
                                         'maxlength'=>50,
                                         'autofocus']) !!}
                        {!! Form::submit('Salvar',
                                        ['class'=>'float-end btn btn-primary mt-3']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection