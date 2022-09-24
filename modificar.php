<?php
require_once 'clases/Usuario.php';
require_once 'clases/ControladorSesion.php';

// Validamos que el usuario tenga sesión iniciada:
session_start();
if (isset($_SESSION['usuario'])) {
    // Si es así, recuperamos la variable de sesión
    $usuario = unserialize($_SESSION['usuario']);
} else {
    // Si no, redirigimos al login
    header('Location: index.php');
}

// Validamos que hayan llegado los datos por POST:
if (
    !empty($_POST['usuario'])
    && !empty($_POST['nombre'])
    && !empty($_POST['apellido'])
    && !empty($_POST['email'])
) {
    $cs = new ControladorSesion();
    // Enviamos los valores al controlador para que los datos sean modificados:
    $result = $cs->modificar(
        $_POST['usuario'],
        $_POST['nombre'],
        $_POST['apellido'],
        $_POST['email'],
        $usuario
    );
    // El segundo elemento ([1]) del array retornado por el método "modificar"
    // del controlador, contiene un mensaje de éxito o error, según corresponda.
    // Redirigimos al home con ese mensaje:
    $redirigir = 'home.php?mensaje='.$result[1];
} else {
    $mensaje = "No fue posible modificar tus datos.";
    $redirigir = "home.php?mensaje=$mensaje";
    // Si no llegaron por POST los datos esperados, redirige al home:
}
header("Location: $redirigir");
