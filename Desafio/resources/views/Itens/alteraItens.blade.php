<html>
   <head>
      <title>Lista de itens</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"> 
       </script>
      <script src = "https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js">
      </script>
            
      <script>    
      
          
        function adicionar(){            
           $('#novo').click(function(e) {            
            e.preventDefault();
                $_token               = "{{ csrf_token() }}";
                var url               = "http://localhost:8000/itens";
                var $post             = {};
                $post.produto         = $('#txtproduto').val();
                $post.quantidade      = $('#txtquantidade').val();
                $post.valor           = $('#txtvalor').val();
                $post._token          = $_token;               
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $post,
                    cache: false,
                    success: function(data){
                        $('#mensagemAlterar').hide();
                        $("#mensagemErro").hide();
                        $('#mensagemAdicionar').show().html('Cadastro efetuado com sucesso');                        
                        $('#lista').empty();
                        listaItens();
                    },error: function(data)
                        {                           
                            $('#mensagemAlterar').hide();
                            $('#mensagemAdicionar').hide();      
                            $('#mensagemErro').show().html('Erro ao salvar, verifique os campos');                       
                        }
                });
                return false;
            });
        }

        function alterar(obj){
           $('#spanAlterar').click(function(e) {
                pid = $('#spanAlterar').attr('class');                            
                e.preventDefault();
                $_token               = "{{ csrf_token() }}";
                var url               = "http://localhost:8000/itens/" + pid;
                var $post             = {};
                $post.produto         = $('#txtproduto').val();
                $post.quantidade      = $('#txtquantidade').val();
                $post.valor           = $('#txtvalor').val();
                $post._token          = $_token;   
                $post._method          = 'put';  
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $post,
                    cache: false,
                    success: function(data){
                        $('#mensagemAdicionar').hide();
                        $("#mensagemErro").hide();
                        $('#mensagemAlterar').show().html('Alteração efetuada com sucesso');                        
                        $("#spanAlterar").removeClass(pid)
                        $('#txtproduto').val('');
                        $('#txtquantidade').val('');
                        $('#txtvalor').val('');
                        $('#lista').empty();
                        listaItens();
                    },error: function(data)
                        {                           
                            $('#mensagemAlterar').hide();
                            $('#mensagemAdicionar').hide();      
                            $('#mensagemErro').show().html('Erro ao salvar, verifique os campos');                       
                        }
                });
                return false;
            });                       
        }

        function deletar(obj){
            if(confirm("Confirma a exclusão ?")){
                var vid = ($(obj).attr('class'));
                $.ajax({
                    url:'http://localhost:8000/itens/' + vid,
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
            
             $.getJSON('http://localhost:8000/itens', function(data) {
                  $.each(data, function(index) {                       
                         $('#lista').append('<tr id=l_' + index + '>' +
                              '<td id=id'+ (data[index].id) + ' >'+(data[index].id)+'</td>' +
                              '<td id=p' + (data[index].id) + ' >'+(data[index].produto)+'</td>' +
                              '<td id=q' + (data[index].id) + ' >'+(data[index].quantidade)+'</td>' +
                              '<td id=v' + (data[index].id) + ' >'+(data[index].valor)+'</td>' +
                              '<td class="actions">'+                                    
                                    ' <span class=' + (data[index].id) + ' onclick="preencherCampos(this)">'+
                                    ' <a class="btn btn-warning btn-xs" href="#">Editar</a></span>'+                                   
                              '</td>'+
                       '</tr>')
                  });
            });
            $("#novo").show();
            $("#alterar").hide();
        }

       function preencherCampos(obj){  
                var vid = ($(obj).attr('class'));
                //alert($('#v' + vid).text());
                $('#txtproduto').val($('#p' + vid).text());
                $('#txtquantidade').val($('#q' + vid).text());
                $('#txtvalor').val($('#v' + vid).text());
                $("#novo").hide();
                $("#alterar").show();
                $("#spanAlterar").addClass(vid);
       }        


        $( document ).ready(function () {
            listaItens();
            adicionar();
            alterar();
            $("#alterar").hide();
            $("#mensagemAdicionar").hide();
            $("#mensagemAlterar").hide();
            $("#mensagemErro").hide();
        })

      </script>
   </head>
   
   <body>

   <div id="mensagemAdicionar" class="alert alert-success">
   </div>
   <div id="mensagemAlterar" class="alert alert-warning">
   </div>
    <div id="mensagemErro" class="alert alert-danger">
   </div>
   
    <div class="col-md-8">
            <h2>Lista de Itens</h2>
            <span><a class="btn btn-warning btn-xs" href="http://localhost:8000"><- Voltar para tela anterior</a> </span> 
            <hr style="height:3px; border:none; color:#000; background-color:#000; margin-top: 0px; margin-bottom: 0px;"/>
            <br />
    </div>

    @if(count($errors)>0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form>

    <div class="row">
    <div class="container">
    <div class="col-md-12">
        <div class="input-group h4">
            <label for="txtproduto">Produto:</label>
            <input id="txtproduto" class="form-control" size="90"  type="text" name="cproduto" placeholder="Produto">         
        </div>
        <div class="input-group h4">
            <label for="txtquantidade">Quantidade:</label>
            <input id="txtquantidade" class="form-control" size="45" type="text" name="cquantidade" placeholder="Quantidade">         
        </div>
        <div class="input-group h4">
            <label for="txtvalor">Valor R$:</label>
            <input id="txtvalor" class="form-control" size="53" type="text" name="cvalor" placeholder=" Ex.: 0.00">         
        </div>
        <div class="row"> 
            <div class="col-md-12">
                <a href="#" id="novo" class="btn btn-primary pull-left h2">Incluir Item</a>
            </div>  
            <div class="col-md-12" >
                <span id="spanAlterar" ><a href="#" id="alterar" class="btn btn-warning pull-left h2">  Alterar Item </a></span>
            </div>  
        </div>
    </div>
    </div>
    </div>
    <div class="row">
        <br />
       <hr style="height:2px; border:none; color:#000; background-color:#000; margin-top: 0px; margin-bottom: 0px;"/>
    </div>
    <div id="list" class="row"> 
        <div class="table-responsive col-md-12">
            <table class="table table-striped" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Valor Unitário</th>
                        <th class="actions">Ações</th>
                    </tr>
                </thead>
                <tbody id='lista'>
                </tbody>
            </table> 
        </div>
    </div> 
    </form>
     
   </body>

</html>