<!DOCTYPE html>
<html>
<head>
 		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"> 
      </script>

	<title>Pedidos</title>

	<script>
			function listaItens(){                   
                    $.getJSON('http://localhost:8000/pedidos', function(data) {
                        $.each(data, function(index) {                       
                                $('#lista').append('<tr id=l_' + index + '>' +
                                    '<td id=id'+ (data[index].id) + ' >'+(data[index].id)+'</td>' +
                                    '<td id=p' + (data[index].id) + ' >'+(data[index].cliente)+'</td>' +
                                    '<td id=q' + (data[index].id) + ' >'+(data[index].desconto)+'</td>' +
                                    '<td id=v' + (data[index].id) + ' >'+(data[index].valor)+'</td>' +
                                     '<td id=v' + (data[index].id) + ' >'+(data[index].total)+'</td>' +
									'<td id=v' + (data[index].id) + ' >'+(data[index].created_at)+'</td>' +
									'<td id=v' + (data[index].id) + ' >'+(data[index].status)+'</td>' +
                                    '<td class="actions">'+                                       
                                        ' <span class=' + (data[index].id) + '>'+
                                        ' <a class="btn btn-warning btn-xs" href="http://localhost:8000/pedidos/'+(data[index].id)+'">Editar</a></span>'+                                       
                                    '</td>'+
                            '</tr>')
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
<span><a class="btn btn-warning btn-xs" href="http://localhost:8000"><- Voltar para tela anterior</a> </span> 
<hr style="height:3px; border:none; color:#000; background-color:#000; margin-top: 0px; margin-bottom: 0px;"/>
 <br />
<h3>PEDIDOS</h3>
	<hr style="height:3px; border:none; color:#000; background-color:#000; margin-top: 0px; margin-bottom: 0px;"/>
   
  <div id="list" class="row"> 
  <div class="container">
        <div class="table-responsive col-md-12">
            <table class="table table-striped" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>Número</th>
                        <th>Cliente</th>
                        <th>Desconto(%)</th>
                        <th>Valor R$</th>
                         <th>Total R$</th>
						<th>Data</th>
						<th>status</th>
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