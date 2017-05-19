<!DOCTYPE html>
<html>
<head>
	<title>Itens</title>
</head>
<body>
	<h2>Itens</h2>
	<ul>
		@foreach ($lItens as $vItem)
			<li>
			<a href="http://localhost:8000/itens/{{$vPedidoCompras->id}}">
			{{$vPedidoCompras->produto}}
			</a>
			</li>
		@endforeach
	</ul>
</body>
</html>