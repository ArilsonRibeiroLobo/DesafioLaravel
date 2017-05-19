<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Pedido;

class pedidosController extends Controller
{
    public function index(){
		//Log::info('teste');		

		 return Response()->json(DB::select(DB::raw(
            "
            select p.id, p.cliente, p.desconto, sum(i.valor) as valor, (sum(i.valor)-(sum(i.valor)*(p.desconto/100))) as total, 
			p.created_at, p.status
			from pedidos p            
			left join itens_pedidos ip   
			on p.id = ip.idPedido         
            left join itens i
            on i.id = ip.idItem            
            group by p.id, p.cliente, p.desconto,p.created_at, p.status

            "
        )),200);
	} 

	public function show($id){
		//Log::info('teste');
		$pedido = Pedido::find($id);
		return view('pedidos.alteraPedidos', 
			  array('lPedido' => $pedido->id,
					'lCliente' => $pedido->cliente,
					'lDesconto' => $pedido->desconto,
					'lStatus' => $pedido->status,
					'lData' => $pedido->created_at,
					'lValor' => $pedido->valor));
		
	}

	public function store(Request $request){
		$this->validate($request, ['cliente' => 'required|min:3', 'desconto' => 'Numeric',]);		
		Log::info($request->cliente);		
		$cPedido = new pedido ;
		$cPedido->cliente = $request->cliente;
		$cPedido->desconto = $request->desconto;
		$cPedido->status = "Aberto";		
		
			if($cPedido->save()){				
				return Redirect('pedidos/' . $cPedido->id);
			}else{
				return Response("0", 304);
			}		
		
	}

	public function update(Request $request){
		//Log::info($_SERVER['HTTP_REFERER']);
		$this->validate($request, ['cliente' => 'required|min:3', 'desconto' => 'Numeric',]);			
		$cPedido = pedido::find($request->idPedido);		
		$cPedido->cliente = $request->cliente;
		$cPedido->desconto = $request->desconto;
		$cPedido->status = $request->status;		
		
			if($cPedido->save()){				
				return Redirect('pedidos/' . $cPedido->id);
			}else{
				return Response("0", 304);
			}		
		
	}
}
