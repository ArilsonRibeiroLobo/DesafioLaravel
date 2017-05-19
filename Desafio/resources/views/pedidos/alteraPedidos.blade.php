<html>
<head>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"> 
      </script>

      <script>

                 function deletar(obj){
                    if(confirm("Confirma a exclusão ?")){
                        var vid = ($(obj).attr('class'));
                        $.ajax({
                            url:'http://localhost:8000/itens_pedidos/' + vid,
                            type: "POST",
                            data: {_method: 'delete', _token :'{{ csrf_token() }}'},
                            success: function(data){
                                $('#lista').empty();
                                listaItens();
                            }
                        });
                        return false;
                    }                       
                }        

                function listaItens(){
                   
                    var $pid = $('#lblIdPedido').val();               
                    $.getJSON('http://localhost:8000/itens_pedidos/'+$pid, function(data) {
                        var $total = 0;
                        var $totalDesconto = 0;
                        $.each(data, function(index) {                       
                                $('#lista').append('<tr id=l_' + index + '>' +
                                    '<td id=id'+ (data[index].id) + ' >'+(data[index].id)+'</td>' +
                                    '<td id=p' + (data[index].id) + ' >'+(data[index].produto)+'</td>' +
                                    '<td id=q' + (data[index].id) + ' >'+(data[index].quantidade)+'</td>' +
                                    '<td id=v' + (data[index].id) + ' >'+(data[index].valor)+'</td>' +
                                    '<td class="actions">'+
                                        ' <span class=' + (data[index].id) + ' onclick="deletar(this)">'+
                                        ' <a class="btn btn-danger btn-xs"  href="#" > X </a></span>'+
                                    '</td>'+
                            '</tr>')

                            $total = $total + (data[index].valor) ;
                            $('#lblValor').val($total);
                            $('#lblTotal').val($total - ($total*($('#lblDesconto').val()/100)));
                        });
                    });           
                }

      </script>

      <script>
        $( document ).ready(function () {             
            listaItens();            
        })
     </script>
</head>
<body>

@if(count($errors)>0)
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
      </ul>
  </div>
@endif

<h2>Detalhe do Pedido</h2>
<span><a class="btn btn-warning btn-xs" href="http://localhost:8000/listaPedidos"><- Voltar para tela anterior</a> </span> 
<hr style="height:3px; border:none; color:#000; background-color:#000; margin-top: 0px; margin-bottom: 0px;"/>
 <br />
<div class="list-group">

<form action="http://localhost:8000/pedidos/54" method="post" >  
<input name="_token" type="hidden" value="{{ csrf_token() }}">
<input name="_method" type="hidden" value="put">

<div class"container">
    <div class="row">
        <div class="col-md-4"> 
            <div class="container">
            <h4>Número</h4>
            <div class="panel panel-default">
                 <div class="panel-body">
                    <div class="col-xs-4">                   
                            <input class="form-control" id="lblIdPedido" type="text" value={{$lPedido}} disabled>
                            <input name="idPedido" type="hidden" value={{$lPedido}}>
                    </div>                
                </div>
            </div>
            </div>
            <div class="container">
            <h4>Data</h4>
            <div class="panel panel-default">
                 <div class="panel-body">
                    <div class="col-xs-4">                   
                            <input class="form-control" id="ex3" type="text" value={{$lData}} disabled>
                    </div>                
                </div>
            </div>
            </div>           
        </div>       
        
        <div class="col-md-4"> 
            <div class="container">
                <h4>Cliente</h4>
                <div class="panel panel-default">
                <div class="panel-body">
                        <div class="col-xs-4">                   
                                <input class="form-control" id="ex3" type="text" name="cliente" value={{$lCliente}} >
                        </div>                
                    </div>
                </div>
            </div>
            <div class="container">
                <h4>Desconto (%)</h4>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-xs-4">                   
                                <input class="form-control" id="lblDesconto" type="text" name="desconto" value={{$lDesconto}} >
                        </div>                
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">  
            <div class="container">
                <h4>Status : <b><span id="statusPedido">{{$lStatus}}</span></b></h4>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-xs-4">                   
                                <select class="form-control" id="sel1" name="status">
                                    <option>Aberto   </option>
                                    <option>Pago      </option>
                                    <option>Cancelado </option>                                
                                </select>
                                <script>
                                
                                    if($('#statusPedido').text()=='Aberto'){
                                            $('#sel1').prop('selectedIndex', 0); 
                                    }
                                    if($('#statusPedido').text()=='Pago'){
                                            $('#sel1').prop('selectedIndex', 1); 
                                    }
                                    if($('#statusPedido').text()=='Cancelado'){
                                            $('#sel1').prop('selectedIndex', 2); 
                                    }
                                    
                                </script>
                        </div>                
                    </div>                
                </div>
            </div>

            <div class="container">
                <h4>Total \ Total com Desconto (R$)</h4>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-xs-2">                   
                                <input class="form-control" id="lblValor" type="text" value={{$lValor}} disabled>
                        </div>   
                        <div class="col-xs-2">                   
                                <input class="form-control" id="lblTotal" type="text" value="" disabled>
                        </div>              
                    </div>
                </div>
            </div>           
        </div>
        
    </div>

    </div>
</div>

<button type="submit" class="btn btn-primary pull-left h2">  Salvar Detalhe </button>
</form>

 <div id="list" class="row"> 
        <div class="table-responsive col-md-12">
            <div class="col-md-8">
                <h2>Listagem de Itens</h2>
            </div>  
            
            <div class="col-md-4">
                <form action="http://localhost:8000/listaDeItens" method="POST">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <input name="idPedido" type="hidden" value="{{$lPedido}}">
                    <button type="submit" id="novoItem" class="btn btn-success pull-left h2">Incluir Item</button>
                </form>               
            </div>  
           
        </div>
</div>
 <hr style="height:2px; border:none; color:#000; background-color:#000; margin-top: 0px; margin-bottom: 0px;"/>
 
  <div id="list" class="row"> 
        <div class="table-responsive col-md-12">
            <table class="table table-striped" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Valor R$</th>
                        <th class="actions">Ações</th>
                    </tr>
                </thead>
                <tbody id='lista'>
                </tbody>
            </table> 
        </div>
    </div>  

</div>

</body>
</html>