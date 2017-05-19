<!DOCTYPE html>
<html>
<head>
	<title>Item : {{$lItem->produto}}</title>
</head>
<body>
	<h2>Itens</h2>
	<ul>
		<li>	Nome :<b>{{$lItem->produto}}</b>
		<li>	Quantidade : <b>{{$lItem->quantidade}}</b>
		<li>	Valor : <b>{{$lItem->valor}}</b>
	</ul>
	<p><a href="javascript:history.go(-1)">Voltar</a></p>
</body>
</html>