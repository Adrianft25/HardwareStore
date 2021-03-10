<?php 
include("config.php");
if (!empty($_SESSION['idusuarioga'])) {
    header("Location: confirmacionGA.php");
}

include('class/userClass.php');
$usuario = new Usuario();

require_once 'googleLib/GoogleAuthenticator.php';

$ga = new GoogleAuthenticator();

$secret = $ga->createSecret();

$errorRegistro='';
$errorLogin='';

if (!empty($_POST['loginSubmit'])) {
    $usuariomailga = $_POST['usernameEmail'];
    $passuga = $_POST['password'];
    if(strlen(trim($usuariomailga)) > 1 && strlen(trim($passuga)) > 1 ) {
        $idusuarioga = $usuario->loginUsuarios($usuariomailga, $passuga, $secret);
        if ($idusuarioga) {
            header("Location: confirmacionGA.php");
        } else {
            $errorLogin = "Revisa la información del login.";
        }
   }
}

if (!empty($_POST['signupSubmit'])) {
	$nameuga = $_POST['usernameReg'];
	$mailuga = $_POST['emailReg'];
	$passuga = $_POST['passwordReg'];
    $teluga = $_POST['nameReg'];
	$username_check = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $nameuga);
	$email_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $mailuga);
	$password_check = preg_match('~^[A-Za-z0-9!@#$%^&*()_]{6,20}$~i', $passuga);

	if ($username_check && $email_check && $password_check && strlen(trim($teluga)) > 0) {
        $idusuarioga = $usuario->registroUsuarios($nameuga,$passuga,$mailuga,$teluga,$secret);
        if ($idusuarioga) {
            header("Location: confirmacionGA.php");
        } else {
            $errorRegistro = "El nombre de usuario/correo ya está en uso.";
        }
        
    } else {
        $errorLogin = "Asegúrate de introducir datos válidos.";
    }

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
    <div id="login" class="container col-4">
        <h3 class="text-center">Login</h3>
        <form class="form-signin" method="POST" action="" name="login">
            <label class="sr-only">Nombre de usuario</label>
            <input class="form-control" type="text" name="usernameEmail" placeholder="Nombre de usuario" />
            <label class="sr-only">Contraseña</label>
            <input class="form-control" type="password" name="password" placeholder="Contraseña"/>
            <div class="errorMsg"><?php echo $errorLogin; ?></div>
            <br>
            <input id="btnLoginGA" class="btn btn-lg btn-primary btn-block" type="submit" class="button" name="loginSubmit" value="Login">
        </form>
    </div>
    <br>
    <br>
    <div id="signup" class="container col-4">
        <h3 class="text-center">Registro</h3>
        <form method="POST" action="" name="signup">
            <label class="sr-only">Nombre</label>
            <input class="form-control" type="text" name="nameReg" placeholder="Nombre" />
            <label class="sr-only">Email</label>
            <input class="form-control" type="text" name="emailReg" placeholder="Email" />
            <label class="sr-only">Nombre de usuario</label>
            <input class="form-control" type="text" name="usernameReg" placeholder="Nombre de usuario" />
            <label class="sr-only">Contraseña</label>
            <input class="form-control" type="password" name="passwordReg" placeholder="Contraseña"/>
            <div class="errorMsg"><?php echo $errorRegistro; ?></div>
            <br>
            <input id="btnRegGA" type="submit" class="button btn btn-lg btn-primary btn-block" name="signupSubmit" value="Regístrate">
        </form>
    </div>
    <br>
<?php
include 'templates/pie.php';
?>