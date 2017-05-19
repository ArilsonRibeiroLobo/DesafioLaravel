<html>
<head>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"> 
      </script>
</head>
<body>

<h2>Criar Pedido</h2>
<span><a class="btn btn-warning btn-xs" href="http://localhost:8000"><- Voltar para tela anterior</a> </span> 
<hr style="height:3px; border:none; color:#000; background-color:#000; margin-top: 0px; margin-bottom: 0px;"/>
 <br />
@if(count($errors)>0)
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
      </ul>
  </div>
@endif
<div class="container">
<form action="http://localhost:8000/pedidos" method="POST">
  <div class="form-group">
  <input name="_token" type="hidden" value="{{ csrf_token() }}">
    <label for="cliente">Cliente</label>
    <input type="text" class="form-control" id="cliente" name="cliente" placeholder="Nome cliente">
  </div>
  <div class="form-group">
    <label for="desconto">Desconto</label>
    <input type="text" class="form-control" id="desconto" name="desconto" placeholder="% de desconto">
  </div>
  <input 
<button type="submit" class="btn btn-primary"></button>
</form>
</div>
</body>
</html>