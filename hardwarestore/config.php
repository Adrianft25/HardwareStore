<?php
//session_start();
define("KEY", "hardwarestore");
define("COD", "AES-128-ECB");
define("SERVIDOR", "localhost");
define("USUARIO", "root");
define("PASSWORD", "");
define("BD","hardwarestore");

function conexionBD() {

	$hostDB = SERVIDOR;
	$userDB = USUARIO;
	$passDB = PASSWORD;
	$nameDB = BD;

	try {
        $conexionga = new PDO("mysql:host=$hostDB;dbname=$nameDB", $userDB, $passDB);
        $conexionga->exec("set names utf8mb4");
        $conexionga->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexionga;
    }
    catch (PDOException $e) {
        echo "Error en la conexión :(". $e->getMessage();
	}

}
?>