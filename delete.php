<?php
session_start();

require_once 'clases/Usuario.php';
require_once 'clases/ControladorSesion.php';

// Validamos que el usuario tenga sesión iniciada:
if (isset($_SESSION['usuario'])) {
    // Si es así, recuperamos la variable de sesión
    $usuario = unserialize($_SESSION['usuario']);
} else {
    // Si no, redirigimos al login
    header('Location: index.php');
}

// Si no recibió la confirmación, o recibe una confirmación incorrecta, redirige
// al home.
if (empty($_POST['usuario']) || $_POST['usuario'] != $usuario->getUsuario()) {
    header("Location: home.php?mensaje=Error al eliminar el usuario");
    die();
}

$cs = new ControladorSesion();

// Enviamos al controlador de sesión la orden de eliminar el usuario actual.
$result = $cs->eliminar($usuario);
// El segundo elemento ([1]) del array retornado por el método "eliminar"
// del controlador, contiene un mensaje de éxito o error, según corresponda.
// Redirigimos al index con ese mensaje:
$redirigir = 'index.php?mensaje='.$result[1];

// Desturimos la sesión y redirigimos al index:
session_destroy();
header("Location: $redirigir");
