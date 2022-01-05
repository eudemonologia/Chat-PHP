<?php
require '../conexion.php';

session_start();

$con = new Conexion();
$pdo = $con->getPDO();

$id = $_SESSION['user']['id'];
$incoming_id = $_GET['id'];

$sql = "SELECT * FROM mensaje WHERE (outgoing_id ='" . $id . "' OR incoming_id = '" . $id . "') AND (incoming_id = '" . $incoming_id . "' OR outgoing_id = '" . $incoming_id . "') ORDER BY date ASC";
$statement = $pdo->prepare($sql);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
