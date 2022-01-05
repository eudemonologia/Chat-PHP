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

echo json_encode($_POST['message']);
