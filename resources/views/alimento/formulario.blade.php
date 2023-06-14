@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Dados do Alimento
                        <a href="{{ url('alimento') }}" class="btn btn-success btn-sm float-end">
                            Listar Alimentos
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

                        @if(Route::is('alimento.show'))
                            {!! Form::model($alimento,
                                            ['method'=>'PATCH',
                                            'url'=>'alimento/' . $alimento->id]) !!}
                            <div class="text-center">
                                <img
                                    src="{{ url('/') }}/uploads/alimentos/{{ $alimento->icone }}"
                                    alt="{{ $alimento->nome }}"
                                    title="{{  $alimento->nome }}"
                                    class="img-thumbnail"
                                    width="150" />
                            </div>
                        @else
                            {!! Form::open(['method'=>'POST', 'url'=>'alimento']) !!}
                        @endif
                        {!! Form::label('nome', 'Nome') !!}
                        {!! Form::input('text', 'nome',
                                        null,
                                        ['class'=>'form-control',
                                         'placeholder'=>'Nome',
                                         'required',
                                         'maxlength'=>50,
                                         'autofocus']) !!}
                        {!! Form::label('desc', 'Descrição') !!}
                        {!! Form::input('text', 'desc',
                                        null,
                                        ['class'=>'form-control',
                                         'placeholder'=>'Descrição',
                                         'required',
                                         'maxlength'=>150,
                                         'autofocus']) !!}
                        {!! Form::label('preco', 'Preço') !!}
                        {!! Form::input('numeric', 'preco',
                                        null,
                                        ['class'=>'form-control',
                                         'placeholder'=>'Preço',
                                         'required',
                                         'autofocus']) !!}
                        {!! Form::label('restaurante_id', 'Restaurante') !!}
                        {!! Form::select('restaurante_id',
                                            $restaurantes,
                                            null,
                                            ['class' =>'form-control',
                                            'placeholder' =>'Selecione o Restaurante',
                                            'required'])!!}
                        {!! Form::label('categoria_id', 'Categoria') !!}
                        {!! Form::select('categoria_id',
                                            $categorias,
                                            null,
                                            ['class' =>'form-control',
                                            'placeholder' =>'Selecione o Categoria',
                                            'required'])!!}
                        {!! Form::label('icone', 'Icone') !!}
                        {!! Form::file( 'icone',
                                        ['class'=>'form-control btn-sm',]) !!}
                        {!! Form::submit('Salvar',
                                        ['class'=>'float-end btn btn-primary mt-3']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection