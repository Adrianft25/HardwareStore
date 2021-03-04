<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title>HardwareStore</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/estilos2.css">
<link href="https://fonts.googleapis.com/css?family=Hind+Madurai|Black+Ops+One" rel="stylesheet">
<link rel="icon" href="img/logo2.ico">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<head>
	<title>Hardware Store</title>
</head>

<body class="d-flex flex-column h-100">
	<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="barra">
		<a class="navbar-brand" id="brand" href="index.php"><img src="img/logo2.png" alt="Hardware Store">HARDWARE STORE</a>
		<button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div id="my-nav" class="collapse navbar-collapse">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="index.php">Principal<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="productos.php">Productos<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="login.php">Ubicación<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="mostrarCarrito.php">Carrito (<?php echo (empty($_SESSION['CARRITO'])) ? 0 : count($_SESSION['CARRITO']); ?>)<span class="sr-only">(current)</span></a>
				</li>
			</ul>
		</div>
	</nav>
	<br>
	<br>
	<br>
	<div class="container col-2">
		<form id="formIni" class="form-signin" method="POST" action="loginForm.php">
			<h1 class="h3 mb-3 font-weight-normal text-center">Inicia Sesión</h1>
			<label for="" class="sr-only">Username</label>
			<input class="form-control" type="text" name="usernm" maxlength="25" placeholder="Nombre de usuario" id="user" autofocus required>
			<label for="" class="sr-only">Password</label>
			<input class="form-control" type="password" maxlength="25" id="pass" name="passwd" placeholder="Contraseña" required>
			<br>
			<input id="btnComprar" class="btn btn-lg btn-primary btn-block" type="submit" name="btnsesion" value="Iniciar Sesión">
			<p>Si aún no tienes cuenta puedes <a href="registrate.php" id="registlink">registrarte aquí</a>.</p>
		</form>
<?php
include 'templates/pie.php';
?>