<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::paginate(25);
        Paginator::useBootstrap();

        return view('cliente.lista', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cliente.formulario');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cliente = new Cliente();
        $cliente->fill($request->all());
        if ($cliente->save()){
            $request->session()->flash('mensagem_sucesso', "Cliente salvo!");
        } else {
            $request->session()->flash('mensagem_erro', 'Deu erro');
        }
        return Redirect::to('cliente/create');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('cliente.formulario', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $cliente = Cliente::findOrFail($cliente->id);
        $cliente->fill($request->all());
        if ($cliente->save()){
            $request->session()->flash('mensagem_sucesso', 'Cliente alterado');
        } else {
            $request->session()->flash('mensagem_erro', 'Deu Erro');
        }
        return Redirect::to('cliente/' . $cliente->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente = Cliente::findOrFail($cliente->id);
        $cliente->delete();
        return Redirect::to('cliente');
    }

    public function showReport()
    {
        $clientes = Cliente::get();

        $pdf = Pdf::loadView('reports.clientes', compact('clientes'));

        $pdf->setPaper('a4', 'portrait')
            ->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
            ->setEncryption('admin');

        return $pdf
            ->stream('relatorio.pdf');
    }
}