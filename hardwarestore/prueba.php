<?php
	session_start();
	require("conexionBBDD.php");
?>


	<?php
		if(isset($_POST['btnreg']) && $_POST['usernm2'] != "" && $_POST['passwd2'] != "" && $_POST['email2'] != "" && $_POST['movil2'] != "") {
			$username2 = $_POST['usernm2'];
			$passuser2 = $_POST['passwd2'];
			$mailuser = $_POST['email2'];
			$moviluser = $_POST['movil2'];

			$encriptacion = sha1($passuser2);

			$sql2 = "SELECT * FROM usuarios WHERE nomUser = '$username2'";
			$sql3 = "SELECT * FROM usuarios WHERE mailUser = '$mailuser'";

			$result2 = mysqli_query($con,$sql2);
			$result3 = mysqli_query($con,$sql3);

			$contar1 = mysqli_num_rows($result2);
			$contar2 = mysqli_num_rows($result3);

			if($contar1 == 1) {
				echo "<script>alert('Este nombre de usuario ya está registrado')</script>";
				header("location:Register2.php");
			} else if($contar2 == 1) {
				echo "<script>alert('Este correo electrónico ya está registrado');</script>";
				header("location:Register2.php");
			} else {
				$sql = "INSERT INTO usuarios (nomUser, contraUser, mailUser,movilUser) VALUES ('$username2','$encriptacion','$mailuser','$moviluser')";
				$result = mysqli_query($con,$sql);

				$_SESSION['btnsesion']="dog";
				$_SESSION['nombre'] = $username2;
				header("location:bootstrap.php");
			}	
		} else {
			echo "Asegurate de que todos los campos están cubiertos";
		}
	?>


