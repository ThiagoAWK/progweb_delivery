<?php

namespace App\Http\Controllers;

use App\Models\Alimento;
use App\Models\Restaurante;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class AlimentosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alimentos = Alimento::with('restaurante', 'categoria')->paginate(25);
        Paginator::useBootstrap();
        return view('alimento.lista', compact('alimentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $restaurantes = Restaurante::select('nome', 'id')->pluck('nome', 'id');
        $categorias = Categoria::select('nome', 'id')->pluck('nome', 'id');
        return view('alimento.formulario', compact('restaurantes', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, ['image.*', 'mimes:jpeg, jpg, gif, png']);
        $pasta = public_path('/uploads/alimentos');
        if ($request->hasfile('icone')) {
            $foto = $request->file('icone');
            $miniatura = Image::make($foto->path());
            $nomeArquivo = $request->file('icone')->getClientOriginalName();
            if ($miniatura->resize(
                500,
                500,
                function ($constraint) {
                    $constraint->aspectRatio();
                }
            )->save($pasta . '/' . $nomeArquivo)) {
                $nomeArquivo = "semfoto.jpg";
            }
        } else {
            $nomeArquivo = 'semfoto.jpg';
        }
        $alimento = new Alimento();
        $alimento->fill($request->all());
        $alimento->icone = $nomeArquivo;
        if ($alimento->save()){
            $request->session()->flash('mensagem_sucesso', "Alimento salvo!");
        } else {
            $request->session()->flash('mensagem_erro', 'Deu erro');
        }
        return Redirect::to('alimento/create');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $alimento = Alimento::findOrFail($id);
        $restaurantes = Restaurante::select('nome', 'id')->pluck('nome', 'id');
        $categorias = Categoria::select('nome', 'id')->pluck('nome', 'id');
        return view('alimento.formulario', compact('restaurantes', 'categorias', 'alimento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alimento $alimento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $alimento = Alimento::findOrFail($id);
        $alimento->fill($request->all());
        if ($alimento->save()){
            $request->session()->flash('mensagem_sucesso', 'Alimento alterado');
        } else {
            $request->session()->flash('mensagem_erro', 'Deu Erro');
        }
        return Redirect::to('alimento/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $alimento_id)
    {
        $alimento = Alimento::findOrFail($alimento_id);
        $lOk = true;
        if (!empty($alimento->icone)) {
            if ($alimento->icone != 'semfoto.jpg') {
                $lOk = unlink(public_path('uploads/alimentos/') . $alimento->icone);
            }
        }
        if ($lOk) {
            $alimento->delete();
            $request->session()->flash(
                'mensagem_sucesso',
                'Alimento removido com sucesso'
            );
            return Redirect::to('alimento');
        }
    }
}