<?php
	$bbdd_host = "localhost";
	$bbdd_user = "root";
	$bbdd_pass = "";
	$bbdd_nom = "hardwarestore";

	$con = mysqli_connect($bbdd_host,$bbdd_user,$bbdd_pass);

	if (mysqli_connect_errno()) {
		echo "No se ha podido conectar con el host";
	}

	mysqli_select_db($con,$bbdd_nom) or die("Error al conectar con la base de datos");
?>