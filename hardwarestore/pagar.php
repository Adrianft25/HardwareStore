<?php
include 'config.php';
include 'conexionBBDD.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>

<?php 
if($_POST) {
    $total = 0;
    $SID = session_id();
    $Correo = $_POST['email'];
    foreach($_SESSION['CARRITO'] as $indice=>$producto) {
        $total = $total+($producto['PRECIO']*$producto['CANTIDAD']);
    }
    $sentencia = $pdo->prepare("INSERT INTO `ventas` (`ID`, `ClaveTransaccion`, `PaypalDatos`, `Fecha`, `Correo`, `Total`, `status`) 
    VALUES (NULL, :ClaveTransaccion, '', NOW(), :Correo, :Total, 'pendiente');");
    $sentencia->bindParam(":ClaveTransaccion",$SID);
    $sentencia->bindParam(":Correo",$Correo);
    $sentencia->bindParam(":Total",$total);
    $sentencia->execute();
    $idVenta = $pdo->lastInsertId();

    foreach($_SESSION['CARRITO'] as $indice=>$producto) {

        $sentencia = $pdo->prepare("INSERT INTO `detalleventa` (`ID`, `IDVENTA`, `IDPRODUCTO`, `PRECIOUNITARIO`, `CANTIDAD`, `DESCARGADO`) 
        VALUES (NULL, :IDVENTA, :IDPRODUCTO, :PRECIOUNITARIO, :CANTIDAD, '0');");

        $sentencia->bindParam(":IDVENTA",$idVenta);
        $sentencia->bindParam(":IDPRODUCTO",$producto['ID']);
        $sentencia->bindParam(":PRECIOUNITARIO",$producto['PRECIO']);
        $sentencia->bindParam(":CANTIDAD",$producto['CANTIDAD']);
        $sentencia->execute();
    }    
    //echo "<h3>".$total."</h3>";
}
?>
<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=EUR"></script>

<div class="jumbotron text-center">
    <h1 class="display-4">¡Paso Final!</h1>
    <hr class="my-4">
    <p class="lead">Estas a punto de pagar con PayPal la cantidad de:
        <h4><?php echo number_format($total,2);?>€</h4>
        <div id="paypal-button-container"></div>
    </p>
    <p>El envío de paquetes tardará entre 5 y 10 días<br/>
    <strong>(Consulta tus dudas en el siguiente correo: adrianft25@gmail.com)</strong>
    </p>
</div>

    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({

            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: { value: '<?php echo $total;?>'},
                        description:"Compra de productos a Hardware Store: <?php echo number_format($total,2);?>€",
                        custom:"<?php echo $SID;?>#<?php echo openssl_encrypt($idVenta,COD,KEY);?>"
                    }]
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Show a success message to the buyer
                    console.log(data);
                    window.location = "verificador.php?paymentToken="+data.paymentToken+"&paymentID="+data.paymentID;
                });
            }


        }).render('#paypal-button-container');
    </script>

<?php include 'templates/pie.php' ?>