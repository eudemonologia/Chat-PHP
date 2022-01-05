<?php
require_once '../conexion.php';

$con = new Conexion();
$pdo = $con->getPDO();

// Recibir los datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// Validar los datos
if (empty($email) || empty($password)) {
    header('Location: index.php?error=emptyFields');
    exit;
}

// Consultar si el usuario existe y si la contraseña es correcta
$sql = "SELECT * FROM usuario WHERE email = '" . $email . "' AND password = '" . $password . "'";
$statement = $pdo->prepare($sql);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);

// Resultado de la consulta
if ($result) {

    // Guardar los datos del usuario en una sesión
    session_start();
    $_SESSION['user'] = $result;

    // Redireccionar al usuario a la página principal
    header('Location: ../user.php');
    exit;
} else {
    // Redireccionar al usuario a la página de inicio de sesión con un mensaje de error
    header('Location: ../index.php?error=wrongCredentials');
    exit;
}
