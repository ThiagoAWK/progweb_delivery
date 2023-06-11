<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class CategoriasController extends Controller
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
        $categorias = Categoria::paginate(25);
        Paginator::useBootstrap();

        return view('categoria.lista', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categoria.formulario');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categoria = new Categoria();
        $categoria->fill($request->all());
        if ($categoria->save()){
            $request->session()->flash('mensagem_sucesso', "Categoria salvo!");
        } else {
            $request->session()->flash('mensagem_erro', 'Deu erro');
        }
        return Redirect::to('categoria/create');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categoria.formulario', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->fill($request->all());
        if ($categoria->save()){
            $request->session()->flash('mensagem_sucesso', 'Categoria alterado');
        } else {
            $request->session()->flash('mensagem_erro', 'Deu Erro');
        }
        return Redirect::to('categoria/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        return Redirect::to('categoria');
    }
}