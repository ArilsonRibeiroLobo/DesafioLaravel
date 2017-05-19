<!DOCTYPE html>
<html lang="en">
<head>
  <title>Listagem de Itens</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<script>

      function adicionar(obj){
        
       // $('#adiciona').click(function(e) { 
           var $item = ($(obj).attr('class'));             
            
                $_token               = "{{ csrf_token() }}";
                var url               = "http://localhost:8000/itens_pedidos";
                var $post             = {};
                $post.idPedido        = $('#pedidoId').text();
                $post.idItem          = $item ;               
                $post._token          = $_token;   
                            
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $post,
                    cache: false,
                    success: function(data){
                        alert('Item Adicionado');                     
                        $('#lista').empty();
                        listaItens();
                    },error: function(data)
                        {                           
                            alert(data);                           
                        }
                });
                return false;
           // });
        }

      function listaItens(){ 
             $.getJSON('http://localhost:8000/itens', function(data) {
                  $.each(data, function(index) {    
                        
                        if((data[index].quantidade)>0){                   
                            $('#lista').append('<tr id=l_' + index + '>' +
                                  '<td id=id'+ (data[index].id) + ' >'+(data[index].id)+'</td>' +
                                  '<td id=p' + (data[index].id) + ' >'+(data[index].produto)+'</td>' +
                                  '<td id=q' + (data[index].id) + ' >'+(data[index].quantidade)+'</td>' +
                                  '<td id=v' + (data[index].id) + ' >'+(data[index].valor)+'</td>' +
                                  '<td class="actions">'+
                                        ' <span id="adiciona" class=' + (data[index].id) + ' onclick="adicionar(this)">'+
                                        ' <a class="btn btn-success btn-xs" href="#">Adicionar no Pedido</a></span>'+                                    
                                  '</td>'+
                          '</tr>'  
                          )
                        }else{                   
                            $('#lista').append('<tr id=l_' + index + '>' +
                                  '<td id=id'+ (data[index].id) + ' >'+(data[index].id)+'</td>' +
                                  '<td id=p' + (data[index].id) + ' >'+(data[index].produto)+'</td>' +
                                  '<td id=q' + (data[index].id) + ' >'+(data[index].quantidade)+'</td>' +
                                  '<td id=v' + (data[index].id) + ' >'+(data[index].valor)+'</td>' +
                                  '<td class="actions">'+
                                        ' <span class=' + (data[index].id) + '>'+
                                        ' <span class="btn btn-danger btn-xs">Item sem estoque</span></span>'+                                    
                                  '</td>'+
                          '</tr>'  
                          )
                        }
                  });
            });
           
        }


         $( document ).ready(function () {
            listaItens();           
        })


</script>


</head>
<body>

<div class="container">
  <h2>Adicionar Itens</h2>
  <p>Itens cadastrados para adicionar no pedido: <b><span id ="pedidoId">{{$pedidoId}}</span></b></p>    
  <span><a class="btn btn-warning btn-xs" href="http://localhost:8000/pedidos/{{$pedidoId}}"><- Voltar para tela anterior</a> </span> 
  
  <hr style="height:2px; border:none; color:#000; background-color:#000; margin-top: 0px; margin-bottom: 0px;"/> 
  <table class="table table-condensed">
    <thead>
      <tr>
        <th>Id</th>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Valor Unitário</th>
        <th>Ação</th>
      </tr>
    </thead>
    <tbody id='lista'>     
     
    </tbody>
  </table>
</div>

</body>
</html>