<?php
	session_start();
	require("conexionBBDD.php");

	if(isset($_POST['btnsesion'])) {
		if ($_POST['usernm'] != "" && $_POST['passwd'] != "") {
			$username = $_POST['usernm'];
			$passuser = $_POST['passwd'];

			$encriptacion2 = sha1($passuser);

			$sql = $pdo->prepare("SELECT * FROM usuarios WHERE nomUser = '$username' AND contraUser = '$encriptacion2'");
			
			$sql->execute();
            $arrayUsuarios = $sql->fetch(PDO::FETCH_ASSOC);

			if($arrayUsuarios['nomUser'] == $username && $arrayUsuarios['contraUser'] == $encriptacion2) {
                $_SESSION['btnsesion']="dog";
                $_SESSION['nombre'] = $username;
                header("Location: productos.php");

            } else {
                echo("<script>alert('Usuario y/o contraseña incorrecto(s)');
                window.location.href='./login.php';</script>");
            }
		}
	}
?>