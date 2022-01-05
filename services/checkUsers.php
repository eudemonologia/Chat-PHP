<?php
require_once 'conexion.php';

$con = new Conexion();
$pdo = $con->getPDO();

//Consultar todos los usuarios a la base de datos
$sql = "SELECT * FROM usuario";
$statement = $pdo->prepare($sql);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

// Convertir el resultado en un array de objetos
$Users = [];
foreach ($result as $row) {
    $user = new User();
    $user->create($row['id'], $row['name'], $row['email'], $row['image']);
    array_push($Users, $user);
}
