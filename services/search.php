<?php
require_once '../conexion.php';

$con = new Conexion();
$pdo = $con->getPDO();

//Recibir el valor a buscar
$search = $_GET['search'];

//Consultar si ese usuario existe en la base de datos
$sql = "SELECT * FROM usuario WHERE name LIKE '%" . $search . "%'";
$statement = $pdo->prepare($sql);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

// Eliminar al usuario en sesion del resultado
session_start();
$newResult = [];
foreach ($result as $row) {
    if ($row['id'] == $_SESSION['user']['id']) {
        continue;
    } else {
        array_push($newResult, $row);
    }
}


// Retornar el resultado en formato JSON
echo json_encode($newResult);
