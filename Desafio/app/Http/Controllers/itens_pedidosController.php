<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;
use App\itensPedidos;
use App\Itens;

class itens_pedidosController extends Controller
{
    public function index(){		
        
	}

    public function show($id){		
        Log::info('teste-show/'+$id);	
        return Response()->json(DB::select(DB::raw(
            "
            select i.id, i.produto, count(i.quantidade) as quantidade, sum(i.valor) as valor 
            from itens_pedidos ip            
            left join itens i
            on i.id = ip.idItem
            where ip.idPedido = ".$id."
            group by  i.id, i.produto

            "
        )),200);
       
	}

    public function destroy($id){	
        Log::info('teste-delete');	
        $mid = DB::select(DB::raw(
            "
            select MIN(id) as id from itens_pedidos
            where idItem = ".$id
           
        ));        
        //Log::info($mid[0]->id);	
		$dItemPedido = itensPedidos::find($mid[0]->id);
        Log::info($dItemPedido);	
		if($dItemPedido->delete()){
            $aItem = itens::find($id);                    
            $aItem->quantidade = $aItem->quantidade + 1;                    
            if($aItem->save()){
                return Response("1", 201);
            }else{
                return Response("0", 304);
            }	
			return Response("1", 200);
		}else{
			return response("0", 304);
		}
	}

    	
	public function store(Request $request){		
		$cip = new itensPedidos ;
		$cip->idPedido = $request->idPedido;
		$cip->IdItem = $request->idItem;
        
        if($cip->save()){	
            $aItem = itens::find($cip->IdItem);                    
            $aItem->quantidade = $aItem->quantidade - 1;                    
            if($aItem->save()){
                return Response("1", 201);
            }else{
                return Response("0", 304);
            }			
            return  Response("1", 201);
        }else{
            return Response("0", 304);
        }
	}
}
