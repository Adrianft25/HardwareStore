<?php
session_start();
include "conexionBBDD.php";
include 'templates/cabecera.php';

$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtPrecio = (isset($_POST['txtPrecio'])) ? $_POST['txtPrecio'] : "";
$txtDesc = (isset($_POST['txtDesc'])) ? $_POST['txtDesc'] : "";
$txtImagen = (isset($_POST['txtImagen'])) ? $_POST['txtImagen'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";


switch ($accion) {
    case 'btnAdd':
        $sentencia = $pdo->prepare("INSERT INTO productos (Nombre, Precio, Descripcion, Imagen) VALUES (:Nombre, :Precio, :Descripcion, :Imagen);");

        $sentencia->bindParam('Nombre', $txtNombre);
        $sentencia->bindParam('Precio', $txtPrecio);
        $sentencia->bindParam('Descripcion', $txtDescripcion);
        $sentencia->bindParam('Imagen', $txtImagen);
        $sentencia->execute();
        header("location:administrador.php");
        break;

    case 'btnMod':
        $sentencia = $pdo->prepare("UPDATE productos SET(Nombre=:Nombre, Precio=:Precio, Descripcion=:Descripcion, Imagen=:Imagen) WHERE ID=:ID");

        $sentencia->bindParam('Nombre', $txtNombre);
        $sentencia->bindParam('Precio', $txtPrecio);
        $sentencia->bindParam('Descripcion', $txtDescripcion);
        $sentencia->bindParam('Imagen', $txtImagen);
        $sentencia->bindParam('ID', $txtID);
        $sentencia->execute();

        header("location:administrador.php");
        break;

    case 'btnDel':
        $sentencia = $pdo->prepare("DELETE FROM productos WHERE ID=:id");

        $sentencia->bindParam('id', $txtID);
        $sentencia->execute();

        header("location:administrador.php");
        break;

    case 'btnCanc':
        header("location:administrador.php");
        break;
}

$sentencia = $pdo->prepare("SELECT * FROM productos");
$sentencia->execute();
$listaProductos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

//print_r($listaProductos);
?>

<div class="container">
    <form action="" method="post" enctype="multipart/form-data">

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <label for="">Nombre:</label>
                            <input type="text" class="form-control" name="txtNombre" value="" placeholder="" id="txtNombre" require="">
                            <br>

                            <label for="">Precio:</label>
                            <input type="text" class="form-control" name="txtPrecio" placeholder="" id="txtPrecio" require="">
                            <br>

                            <label for="">Descripcion:</label>
                            <input type="text" class="form-control" name="txtDesc" placeholder="" id="txtDesc" require="">
                            <br>

                            <label for="">Imagen:</label>
                            <input type="text" class="form-control" name="txtImagen" placeholder="" id="txtImagen" require="">
                            <br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button value="btnAdd" class="btn btn-success" type="submit" name="accion">Añadir</button>
                        <button value="btnMod" class="btn btn-warning" type="submit" name="accion">Modificar</button>
                        <button value="btnDel" onclick="return Confirmar('Estas seguro de que quieres borrarlo?');" class="btn btn-danger" type="submit" name="accion">Borrar</button>
                        <button value="btnCanc" class="btn btn-primary" type="submit" name="accion">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Agregar Producto</button>

    </form>

    <div class="row">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <?php foreach ($listaProductos as $producto) { ?>
                <tr>
                    <td><?php echo $producto['Imagen']; ?></td>
                    <td><?php echo $producto['Nombre']; ?></td>
                    <td><?php echo $producto['Precio']; ?></td>
                    <td><?php echo $producto['Descripcion']; ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="txtID" value="<?php echo $producto['ID']; ?>">
                            <input type="hidden" name="txtNombre" value="<?php echo $producto['Nombre']; ?>">
                            <input type="hidden" name="txtPrecio" value="<?php echo $producto['Precio']; ?>">
                            <input type="hidden" name="txtDescripcion" value="<?php echo $producto['Descripcion']; ?>">
                            <input type="hidden" name="txtImagen" value="<?php echo $producto['Imagen']; ?>">

                            <input type="submit" value="Seleccionar" class="btn btn-info" name="accion">
                            <button value="btnDel" onclick="return Confirmar('Estas seguro de que quieres borrarlo?');" type="submit" class="btn btn-danger" name="accion">Borrar</button>
                        </form>

                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
<script>
    function Confirmar(Mensaje) {
        return (confirm(Mensaje))?true:false;
    }
</script>
<?php
include 'templates/pie.php';
?>