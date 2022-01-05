<?php
require 'models/User.php';

session_start();
//comprobar si el usuario esta logueado
if (!isset($_SESSION['user'])) {
    // Si no está logueado, redireccionar al usuario a la página de inicio de sesión
    header('Location: index.php');
    exit;
}

$User = new User();
$User->create($_SESSION['user']['id'], $_SESSION['user']['name'], $_SESSION['user']['email'], $_SESSION['user']['image'], $_SESSION['user']['last_activity'], $_SESSION['user']['last_msg']);
