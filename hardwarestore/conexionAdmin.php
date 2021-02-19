<?php
    $servidor = "mysql:dbname=hardwarestore;host=localhost";
    $usuario="root";
    $password="";

    try{
        $pdo = new PDO($servidor,$usuario,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8mb4"));
        /*echo "Conectado";*/
    } catch(PDOException $e) {
        echo "conexion mala :(".$e->getMessage();
    }
?>