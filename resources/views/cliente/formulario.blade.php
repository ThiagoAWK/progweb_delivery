@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Dados do Cliente
                        <a href="{{ url('cliente') }}" class="btn btn-success btn-sm float-end">
                            Listar Clientes
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

                        @if(Route::is('cliente.show'))
                            {!! Form::model($cliente,
                                            ['method'=>'PATCH',
                                            'files'=>'True',
                                            'url'=>'cliente/' . $cliente->id]) !!}
                            <div class="text-center">
                            </div>
                        @else
                            {!! Form::open(['method'=>'POST', 'files'=>'True', 'url'=>'cliente']) !!}
                        @endif
                        {!! Form::label('nome', 'Nome') !!}
                        {!! Form::input('text', 'nome',
                                        null,
                                        ['class'=>'form-control',
                                         'placeholder'=>'Nome',
                                         'required',
                                         'maxlength'=>50,
                                         'autofocus']) !!}
                        {!! Form::label('endereco', 'Endereço') !!}
                        {!! Form::input('text', 'endereco',
                                        null,
                                        ['class'=>'form-control',
                                         'placeholder'=>'Endereço',
                                         'required',
                                         'maxlength'=>50,
                                         'autofocus']) !!}
                        {!! Form::label('fone', 'Telefone') !!}
                        {!! Form::input('text', 'fone',
                                        null,
                                        ['class'=>'form-control',
                                         'placeholder'=>'Telefone',
                                         'required',
                                         'maxlength'=>20,
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
