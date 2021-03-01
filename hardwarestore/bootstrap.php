<?php
include 'config.php';
include 'conexionBBDD.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>
<br>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">Hardware Store</a></li>
		<li class="breadcrumb-item active" aria-current="page">Productos</li>
	</ol>
</nav>
<br>
<?php if ($mensaje != "") { ?>
	<div class="alert alert-success" role="alert">
		<?php echo $mensaje; ?>
		<a href="mostrarCarrito.php" class="badge badge-success">Ver carrito</a>
	</div>
<?php } ?>
<div class="row">

	<?php
	$sentencia = $pdo->prepare("SELECT * FROM productos");
	$sentencia->execute();
	$listaProd = $sentencia->fetchAll(PDO::FETCH_ASSOC);
	?>
	<?php foreach ($listaProd as $producto) { ?>
		<div class="col-md-4 col-sm-6 col-xs-12 d-print-block">
			<div height="400px" class="card">
				<img class="img-fluid" data-toggle="popover" data-trigger="hover" data-content="<?php echo $producto['Descripcion']; ?>" title="<?php echo $producto['Nombre']; ?>" class="card-img-top" src="<?php echo $producto['Imagen']; ?>" alt="<?php echo $producto['Nombre']; ?>">
				<div class="card-body" id="cuerpo">
					<p id="titulo"><?php echo $producto['Nombre']; ?></p>
					<h5 class="card-title"><?php echo $producto['Precio']; ?>€</h5>
					<form action="" method="post">
						<input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY); ?>">
						<input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['Nombre'], COD, KEY); ?>">
						<input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['Precio'], COD, KEY); ?>">
						<input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>">
						<button class="btn btn-primary" id="btnComprar" value="Agregar" name="btnCarrito" type="submit">Comprar</button>
					</form>

				</div>
			</div>
		</div>
	<?php } ?>

</div>

</div>
<br>
<br>
<br>
<br>

<script>
	$(function() {
		$('[data-toggle="popover"]').popover();
	})
</script>
<?php 
include 'templates/pie.php';
?>