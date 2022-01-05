<?php

require '../conexion.php';
session_start();

$con = new Conexion();
$pdo = $con->getPDO();

$sql = "INSERT INTO mensaje (outgoing_id, incoming_id, msg) VALUES (:outgoing_id, :incoming_id, :text)";
$statement = $pdo->prepare($sql);
$statement->bindParam(':outgoing_id', $_SESSION['user']['id']);
$statement->bindParam(':incoming_id', $_POST['receiver']);
$statement->bindParam(':text', $_POST['message']);
$statement->execute();

//actualizar el último mensaje enviado por el usuario
$sql = "UPDATE usuario SET last_msg = :last_msg WHERE id = :id";
$statement = $pdo->prepare($sql);
$statement->bindParam(':last_msg', $_POST['message']);
$statement->bindParam(':id', $_SESSION['user']['id']);
$statement->execute();

echo json_encode($_POST['message']);
