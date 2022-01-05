<?php
// Cerrar la sesión del usuario
session_start();
session_destroy();

// Redireccionar al usuario a la página de inicio de sesión
header('Location: ../index.php');
