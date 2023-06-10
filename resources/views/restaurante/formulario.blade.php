@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Dados do Restaurante
                        <a href="{{ url('restaurante') }}" class="btn btn-success btn-sm float-end">
                            Listar Restaurantes
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

                        @if(Route::is('restaurante.show'))
                            {!! Form::model($restaurante,
                                            ['method'=>'PATCH',
                                            'files'=>'True',
                                            'url'=>'restaurante/'.$restaurante->id]) !!}
                            <div class="text-center">
                            </div>
                        @else
                            {!! Form::open(['method'=>'POST', 'files'=>'True', 'url'=>'restaurante']) !!}
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
