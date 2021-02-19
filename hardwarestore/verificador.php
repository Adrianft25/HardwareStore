<?php
include 'config.php';
include 'conexion2.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>

<?php //La API de PayPal se actualizó, por lo que la información que se muestra en la compra no se corresponde con la clase 
/*
print_r($_GET);

$ClientID = "AY2VbgAkao9rtkA1xf_pmpYcseTpWWeSuQ-y8jKVKexEzGhr0bAugf-WW9rTPLUXYK6J1UJe_mgd8YC1";
$Secret = "EIO4uQ0pK7jdT_A9hrhe4qCg5yl8AkBGm4hNg_SILUeIpcn0DRR3RfI2PmT-DGsXcSAZhX05o737_PpW";

        $Login = curl_init("https://api.sandbox.paypal.com/v1/oauth2/token");
        curl_setopt($Login, CURLOPT_RETURNTRANSFER,TRUE);

        curl_setopt($Login,CURLOPT_USERPWD,$ClientID.":".$Secret);

        curl_setopt($Login,CURLOPT_POSTFIELDS,"grant_type=client_credentials");

        $Respuesta = curl_exec($Login);

        print_r($Respuesta);

        $objRespuesta = json_decode($Respuesta);

        $AccessToken = $objRespuesta->access_token;

        print_r($AccessToken);

    $venta = curl_init("https://api.sandbox.paypal.com/v1/payments/payment?".$_GET['paymentID']);

    curl_setopt($venta,CURLOPT_HTTPHEADER,array("Content-Type: application/json","Authorization: Bearer ".$AccessToken));

    curl_setopt($Login,CURLOPT_RETURNTRANSFER,TRUE);

    $RespuestaVenta = curl_exec($venta);

    //print_r($RespuestaVenta);

    $objDatosTransaccion = json_decode($RespuestaVenta);

    //print_r($objDatosTransaccion->state);

    $state = $objDatosTransaccion->state;
    $emai = $objDatosTransaccion->payer->payer_info->email;

    $total = $objDatosTransaccion->transactions[0]->amount->total;
    $currency = $objDatosTransaccion->transactions[0]->amount->currency;
    $custom = $objDatosTransacciontransactions[0]->custom;


    $clave = explode("#",$custom);

    $SID = $clave[0];
    $claveVenta = openssl_decrypt($clave[1],COD,KEY);

    curl_close($venta);
    curl_close($Login);


    if($state=="approved") {
        $mensajePaypal = "<h3>Pago aprovado</h3>";
        $sentencia = $pdo->prepare("UPDATE `ventas` SET `PaypalDatos` = :PaypalDatos, `status` = 'aprovado' WHERE (`ID` = :ID);");
        $sentencia->$bindParam(":ID", $claveVenta);
        $sentencia->$bindParam(":PaypalDatos", $RespuestaVenta);
        $sentencia->execute();

        $sentencia = $pdo->prepare("UPDATE `ventas` SET `status` = 'completo' WHERE (`ClaveTransaccion` = :ClaveTransaccion) AND Total = :TOTAL AND ID = :ID;");
        $sentencia->$bindParam(":claveTransaccion", $SID);
        $sentencia->$bindParam(":TOTAL", $total);
        $sentencia->$bindParam(":ID", $claveVenta);
        $sentencia->execute();
    } else {
        $mensajePaypal = "<h3>Hay un problema con el pago</h3>";
    }
    */
    $sentencia = $pdo->prepare("UPDATE `ventas` SET `status` = 'completo' WHERE (`status` = 'pendiente');");
    $sentencia->execute();
?>

<div class="jumbotron">
    <h1 class="display-4">¡Listo!</h1>
    <hr class="my-4">
    <p class="lead">Su transacción se ha realizado con éxito</p>
    <p></p>
</div>

<?php 
session_destroy();
?>