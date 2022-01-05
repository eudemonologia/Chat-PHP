<?php
require '../conexion.php';
session_start();

$con = new Conexion();
$pdo = $con->getPDO();

$id = $_SESSION['user']['id'];

// borrar al usuario en sesion
$sql = "DELETE FROM usuario WHERE id = '" . $id . "'";
$statement = $pdo->prepare($sql);
$statement->execute();

// borrar los mensajes de la base de datos
$sql = "DELETE FROM mensaje WHERE outgoing_id = '" . $id . "' OR incoming_id = '" . $id . "'";
$statement = $pdo->prepare($sql);
$statement->execute();

//borrar la imagen de la carpeta
$image = $_SESSION['user']['image'];
unlink($image);

//borrar la sesión
session_destroy();


header('Location: ../index.php');
