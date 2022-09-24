<?php
require_once 'clases/Usuario.php';
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $nomApe = $usuario->getNombreApellido();
} else {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Sistema bancario</title>
        <link rel="stylesheet" href="bootstrap.min.css">
    </head>
    <body class="container">
      <div class="jumbotron text-center">
      <h1>Sistema bancario</h1>
      </div>
      <div class="text-center">
        <?php
            if (isset($_GET['mensaje'])) {
                echo '<div id="mensaje" class="alert alert-primary text-center">
                    <p>'.$_GET['mensaje'].'</p></div>';
            }
        ?>
        <h3>Hola <?php echo $nomApe;?></h3>
        <p><?php echo $usuario->getEmail();?></p>
        <p><a href="datos_modificar.php">Modificar mis datos</a></p>
        <p><a href="confirmar_delete.php" class="btn btn-danger">Eliminar mis datos</a></p>
        <p><a href="logout.php">Cerrar sesión</a></p>
      </div>
    </body>
</html>

