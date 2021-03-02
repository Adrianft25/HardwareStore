<?php
require("conexionBBDD.php");
if (!$_SESSION['btnsesion']) {
	header("location:Register.php");
}

?>
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
		<a class="navbar-brand" id="brand" href="Principal.php"><img src="img/logo2.png" alt="Hardware Store">HARDWARE STORE</a>
		<button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div id="my-nav" class="collapse navbar-collapse">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="Principal.php">Principal<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="productos.php">Productos<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="ubicacion.php">Ubicación<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item active">
                    <a class="nav-link" href="mostrarCarrito.php">Carrito (<?php echo (empty($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']);?>)<span class="sr-only">(current)</span></a>
				</li>
			</ul>
			<a href="administrador.php"><span id="nomsesion" class="mr-sm-2"><?php echo $_SESSION['nombre'];?></span></a>
			<a class="btn btn-danger my-2 my-lg-0" href="cerrarsesion.php" id="btncerrar">Cerrar Sesión<span class="sr-only">(current)</span></a>
		</div>
	</nav>
	<br>
	<br>
	<div class="container">