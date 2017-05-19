<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Itens;

class ItensController extends Controller
{
    public function todosItens(Request $request){		
		return View('itens/listaDeItens')->with('pedidoId' , $request->idPedido);
	}
	public function index(){		
		return Response()->json(Itens::orderBy('id', 'desc')->get(),200);
	}

	public function show($id){	
		return view('listaDeItens', ['pedidoId' => $id]);
       
	}

	public function store(Request $request){
		$this->validate($request, ['quantidade' => 'Numeric','valor' => 'Numeric',]);		
		$cItem = new itens ;
		$cItem->produto = $request->produto;
		$cItem->quantidade = $request->quantidade;
		$cItem->valor = $request->valor;
		if($cItem->save()){
			return Response("1", 201);
		}else{
			return Response("0", 304);
		}
	}

	public function destroy($id){		
		$dItem = itens::find($id);
		if($dItem->delete()){
			return Response("1", 200);
		}else{
			return response("0", 304);
		}
	}

	public function update( Request $request, $pid){
		$this->validate($request, ['quantidade' => 'Numeric','valor' => 'Numeric',]);	
		$aItem = itens::find($pid);
		$aItem->produto = $request->produto;
		$aItem->quantidade = $request->quantidade;
		$aItem->valor = $request->valor;
		if($aItem->save()){
			return Response("1", 201);
		}else{
			return Response("0", 304);
		}
	}
}
