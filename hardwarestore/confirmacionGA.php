 <?php
include('config.php');

if (empty($_SESSION['idusuarioga'])) {
	header("Location: index.php");
}

include('class/userClass.php');

$usuario = new Usuario();

$detalleUsuario = $usuario->detallesUsuarios($_SESSION['idusuarioga']);

$secret = $detalleUsuario->codigouga;
$mailuga = $detalleUsuario->mailuga;

require_once 'googleLib/GoogleAuthenticator.php';

$ga = new GoogleAuthenticator();

$codigoQR = $ga->getQRCodeGoogleUrl($mailuga, $secret,'HardwareStore');


?>

<!DOCTYPE html>
<html>
	<head>
		<title>Verificación con Google Authenticator</title>
		<link rel="stylesheet" type="text/css" href="style.css" charset="utf-8" />
	</head>
	<body>
		<div id="container">
			<div id='device'>
				<p>Introduce el código de Google Authenticator de la aplicación móvil</p>
				<div id="img">
					<img src='<?php echo $codigoQR; ?>' />
				</div>
				<form method="post" action="login.php">
					<label>Introduce el código</label>
					<input type="text" name="code" />
					<input type="submit" class="button"/>
				</form>
			</div>
		</div>
	</body>
</html>
