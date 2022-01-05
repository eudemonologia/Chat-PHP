<?php
require_once 'conexion.php';

$con = new Conexion();
$pdo = $con->getPDO();

//Consultar todos los usuarios a la base de datos
$sql = "SELECT * FROM usuario";
$statement = $pdo->prepare($sql);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

// Cambiar el last_activity a la hora actual
$sql = "UPDATE usuario SET last_activity = '" . date('Y-m-d H:i:s') . "' WHERE id = " . $_SESSION['user']['id'];
$statement = $pdo->prepare($sql);
$statement->execute();

// Convertir el resultado en un array de objetos
$Users = [];
foreach ($result as $row) {
    $user = new User();
    $user->create($row['id'], $row['name'], $row['email'], $row['image'], $row['last_activity'], $row['last_msg']);
    array_push($Users, $user);
}
