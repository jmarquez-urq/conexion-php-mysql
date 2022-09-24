<?php
require_once 'clases/Usuario.php';
require_once 'clases/ControladorSesion.php';

// Validamos que el usuario tenga sesión iniciada:
session_start();
if (isset($_SESSION['usuario'])) {
    // Si es así, recuperamos la variable de sesión
    $usuario = unserialize($_SESSION['usuario']);

    $nombre_usuario = $usuario->getUsuario();
    $nombre = $usuario->getNombre();
    $apellido = $usuario->getApellido();
    $email = $usuario->getEmail();

} else {
    // Si no, redirigimos al login
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Bienvenido al sistema</title>
        <link rel="stylesheet" href="bootstrap.min.css">
    </head>
    <body class="container">
      <div class="jumbotron text-center">
      <h1>Sistema bancario</h1>
      </div>
      <div class="text-center">
        <h3>Modificar datos de usuario</h3>
        <form action="modificar.php" method="post">
            <label for="usuario">Nombre de usuario</label>
            <input name="usuario" class="form-control form-control-lg" placeholder="Usuario" value="<?php echo $nombre_usuario;?>"><br>
            <label for="nombre">Nombre</label>
            <input name="nombre" class="form-control form-control-lg" placeholder="Nombre" value="<?php echo $nombre;?>"><br>
            <label for="usuario">Apellido</label>
            <input name="apellido" class="form-control form-control-lg" placeholder="Apellido" value="<?php echo $apellido;?>"><br>
            <label for="usuario">Email</label>
            <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" value="<?php echo $email;?>"><br>
            <input type="submit" value="Modificar datos" class="btn btn-primary">
        </form>
      </div>
    </body>
</html>
