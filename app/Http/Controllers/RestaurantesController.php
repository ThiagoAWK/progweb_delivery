<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class RestaurantesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listar()
    {
        $restaurantes = Restaurante::paginate(25);
        Paginator::useBootstrap();

        return view('restaurante.lista', compact('restaurantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('restaurante.formulario');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $restaurante = new Restaurante();
        $restaurante->fill($request->all());
        if ($restaurante->save()){
            $request->session()->flash('mensagem_sucesso', "Restaurante salvo!");
        } else {
            $request->session()->flash('mensagem_erro', 'Deu erro');
        }
        return Redirect::to('restaurante/create');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $restaurante = Restaurante::findOrFail($id);
        return view('restaurante.formulario', compact('restaurante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurante $restaurante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurante $restaurante)
    {
        $restaurante = Restaurante::findOrFail($restaurante->id);
        $restaurante->fill($request->all());
        if ($restaurante->save()){
            $request->session()->flash('mensagem_sucesso', 'Restaurante alterado');
        } else {
            $request->session()->flash('mensagem_erro', 'Deu Erro');
        }
        return Redirect::to('restaurante/' . $restaurante->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurante $restaurante)
    {
        $restaurante = Restaurante::findOrFail($restaurante->id);
        $restaurante->delete();
        return Redirect::to('restaurante');
    }

    public function showReport()
    {
        $restaurantes = Restaurante::get();

        $pdf = Pdf::loadView('reports.restaurantes', compact('restaurantes'));

        $pdf->setPaper('a4', 'portrait')
            ->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
            ->setEncryption('123');

        return $pdf
            ->stream('relatorio.pdf');
    }
}