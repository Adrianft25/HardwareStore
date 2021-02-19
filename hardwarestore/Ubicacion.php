<?php
session_start();
include 'templates/cabecera.php';
?>

<br>
<br>

<div class="container">
    <h1 class="text-center">Dónde estamos?</h1>
    <hr>
    <div class="row">
        <div class="col-sm-8">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1450.229995042047!2d-8.421424986165066!3d43.367405069753985!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2e7c606f0ca0bd%3A0xca9147484acf9663!2sPaseo+Ronda%2C+15011+La+Coru%C3%B1a!5e0!3m2!1ses!2ses!4v1560079223518!5m2!1ses!2ses" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>

        <div class="col-sm-4" id="contact2">
            <h3>Sede y Contacto</h3>
            <hr align="left" width="50%">
            <h4 class="pt-2">Sede operativa</h4>
            <i class="fas fa-globe" style="color:#000"></i>Paseo de Ronda, 26 15011 A Coruña<br>
            <h4 class="pt-2">Número de Teléfono</h4>
            <i class="fas fa-phone" style="color:#000"></i>  981659856 </a><br>
            <h4 class="pt-2">Email de Contacto</h4>
            <i class="fa fa-envelope" style="color:#000"></i> <a href="#" id="correo">HardwareStore@gmail.com</a><br>
            <h4 class="pt-2">Redes Sociales</h4>
            <a href="#" id="face">Facebook</a>
            <br>
            <a href="#" id="tw">Twitter</a>
            <br>
            <a href="#" id="insta">Instagram</a>
        </div>
    </div>
</div>



<br><br>

<?php
include 'templates/pie.php';
?>