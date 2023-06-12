<?php


namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\Restaurante;
use App\Models\Alimento;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class CarrinhosController extends Controller
{
    public function listarCarrinho()
    {
        $carrinhoItems = Carrinho::all();;

        $alimentosCarrinho = [];
        foreach ($carrinhoItems as $carrinhoItem) {
            $alimento = Alimento::findOrFail($carrinhoItem->alimento_id);
            $alimentosCarrinho[] = [
                'alimento' => $alimento,
                'quantidade' => $carrinhoItem->quantidade,
            ];
        }

        return view('carrinho.lista', compact('alimentosCarrinho'));
    }

    public function adicionarCarrinho(Request $request)
    {
        $request->validate([
            'alimento_id' => 'required|exists:alimentos,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        $alimentoId = $request->input('alimento_id');
        $quantidade = $request->input('quantidade');
        $carrinho = new Carrinho();
        $carrinho->alimento_id = $alimentoId;
        $carrinho->quantidade = $quantidade;
        $carrinho->save();

        return redirect()->back()->with('mensagem_sucesso', 'Alimento Adicionado ao Carrinho!');
    }

    public function removerCarrinho(Request $request)
    {
        $request->validate([
            'alimento_id' => 'required|exists:alimentos,id',
        ]);

        $alimentoId = $request->input('alimento_id');
        Carrinho::where('alimento_id', $alimentoId)->delete();

        return redirect()->route('carrinho.lista')->with('mensagem_sucesso', 'Alimento Removido do Carrinho!');
    }
}
