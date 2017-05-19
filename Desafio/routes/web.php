<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/alteraItens', function(){
    return view('itens.alteraItens');
});

Route::get('/', function(){
    return view('pedidos.principal');
});

Route::get('/cadastraPedido', function(){
    return view('pedidos.cadastraPedidos');
});
Route::get('/listaPedidos', function(){
    return view('pedidos.listaPedidos');
});

Route::get('/listaDeItens', function(){
    return view('itens.listaDeItens');
});

Route::post('listaDeItens', 'ItensController@todosItens');

Route::resource('itens', 'ItensController');
Route::resource('itens_pedidos', 'itens_pedidosController');
Route::resource('pedidos', 'PedidosController');
    
    
    
    

    




    