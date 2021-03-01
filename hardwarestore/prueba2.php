<?php
	session_start();
	require("conexionBBDD.php");

	if(isset($_POST['btnsesion'])) {
		if ($_POST['usernm'] != "" && $_POST['passwd'] != "") {
			$username = $_POST['usernm'];
			$passuser = $_POST['passwd'];

			$encriptacion2 = sha1($passuser);

			$sql4 = "SELECT * FROM usuarios WHERE nomUser = '$username' AND contraUser = '$encriptacion2'";

			//$sql4 = "SELECT idAdmin FROM usuarios WHERE nomUser = 'admin' AND idusuarios = '1'";

			$result4 = mysqli_query($con,$sql4);

			$contar4 = mysqli_num_rows($result4);

			if ($contar4 == 1) {
				$_SESSION['btnsesion'] = 'dog';
				$_SESSION['nombre'] = $username;
				header("location:bootstrap.php");
			} else {
				header("location:Register.php");
				echo "<script>alert('Usuario o contraseña incorrecto(s)')</script>";
			}
		} else {
			echo "Rellena todos los campos";
		}
	}
?>