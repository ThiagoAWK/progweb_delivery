<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class ContatosController extends Controller
{
    public function index()
    {
        return view('public_view.contato');
    }

    public function enviar(Request $request)
    {
        Contato::create([
            'nome' => $request['nome'],
            'email' => $request['email'],
            'fone' => $request['fone'],
            'mensagem' => $request['mensagem'],
        ]);
        $dest_nome = "Thiago";
        $dest_email = "thiago.kniphoff@aluno.famper.edu.br";
        $dados = array(
            'nome' => $request['nome'],
            'email' => $request['email'],
            'fone' => $request['fone'],
            'mensagem' => $request['mensagem']
        );
        Mail::send(
            'email.contato',
            $dados,
            function ($mensagem) use ($dest_nome, $dest_email, $request) {
                $mensagem->to($dest_email, $dest_nome)
                    ->subject('E-mail do site Famper!')
                    ->bcc(['thiago.kniphoff@aluno.famper.edu.br', 'thiago.kniphoff@aluno.famper.edu.br']);
                $mensagem->from($request['email'], $request['nome']);
            }
        );
        return Redirect::to('contatos')
            ->with('mensagem-sucesso', 'E-mail enviado com sucesso!');
    }
}