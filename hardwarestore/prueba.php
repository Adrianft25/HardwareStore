<?php
	session_start();
	require("conexionBBDD.php");

		if(isset($_POST['btnreg']) && $_POST['usernm2'] != "" && $_POST['passwd2'] != "" && $_POST['email2'] != "" && $_POST['movil2'] != "") {
			$username2 = $_POST['usernm2'];
			$passuser2 = $_POST['passwd2'];
			$mailuser = $_POST['email2'];
			$moviluser = $_POST['movil2'];

			$encriptacion = sha1($passuser2);

			$sql2 = $pdo->prepare("SELECT * FROM usuarios WHERE nomUser = '$username2'");
			$sql3 = $pdo->prepare("SELECT * FROM usuarios WHERE mailUser = '$mailuser'");

			$sql2->execute();
			$sql3->execute();

			$usuarioExiste = $sql2->fetch(PDO::FETCH_ASSOC);
			$correoExiste = $sql3->fetch(PDO::FETCH_ASSOC);

			if($usuarioExiste['nomUser'] == $username2) {
				echo "<script>alert('Este nombre de usuario ya está registrado');
				window.location.href='./Register2.php';</script>";
			} else if($correoExiste['mailUser'] == $mailuser) {
				echo "<script>alert('Este correo electrónico ya está registrado');
				window.location.href='./Register2.php';</script>";
			} else {
				$sql4 = $pdo->prepare("INSERT INTO usuarios (nomUser, contraUser, mailUser,movilUser) VALUES ('$username2','$encriptacion','$mailuser','$moviluser')");
				$sql4->execute();

				$_SESSION['btnsesion']="dog";
				$_SESSION['nombre'] = $username2;
				header("location:productos.php");
			}	
		} else {
			echo "Asegurate de que todos los campos están cubiertos";
		}
	?>


