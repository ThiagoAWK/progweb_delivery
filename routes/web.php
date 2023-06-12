<?php

use App\Http\Controllers\RestaurantesController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\AlimentosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ContatosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/restaurante', [RestaurantesController::class, 'listar'])->name('restaurante.listar');
Route::get('/restaurante/create', [RestaurantesController::class, 'create'])->name('restaurante.create');
Route::get('/restaurante/report', [RestaurantesController::class, 'ShowReport']);
Route::get('/cliente/report', [ClientesController::class, 'ShowReport']);
Route::get('/alimento/report', [AlimentosController::class, 'ShowReport']);
Route::get('/restaurante/{restaurante_id}', [RestaurantesController::class, 'show'])->name('restaurante.show');
Route::get('/restaurante/alimento/{restaurante_id}', [RestaurantesController::class, 'cardapio']);
Route::post('/restaurante', [RestaurantesController::class, 'store']);
Route::patch('/restaurante/{restaurante}', [RestaurantesController::class, 'update']);
Route::delete('/restaurante/{restaurante}', [RestaurantesController::class, 'destroy']);

Route::resource('categoria', CategoriasController::class);
Route::resource('alimento', AlimentosController::class);
Route::resource('cliente', ClientesController::class);

Route::get('contatos', [ContatosController::class, 'index']);
Route::post('contatos', [ContatosController::class, 'enviar']);

Route::get('/carrinho', [RestaurantesController::class, 'exibirCarrinho'])->name('carrinho.exibir');
Route::post('/carrinho/adicionar', [RestaurantesController::class, 'adicionarCarrinho'])->name('carrinho.adicionar');
Route::post('/carrinho/remover', [RestaurantesController::class, 'removerCarrinho'])->name('carrinho.remover');