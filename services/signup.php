<?php
require_once '../conexion.php';

$con = new Conexion();
$pdo = $con->getPDO();

// Recibir los datos del formulario
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];
$image = $_FILES['image'];

// Validar los datos
if (empty($name) || empty($email) || empty($password) || empty($repassword)) {
    header('Location: ../register.php?error=emptyFields');
    exit;
}

// Validar que las contraseñas coincidan
if ($password != $repassword) {
    header('Location: ../register.php?error=passwordsDontMatch');
    exit;
}

// Validar si la imagen existe y si es una imagen
if ($image['size'] > 0) {
    if ($image['type'] != 'image/jpeg' && $image['type'] != 'image/png') {
        header('Location: ../register.php?error=wrongImageType');
        exit;
    }
}

// Validar que el usuario no exista
$sql = "SELECT * FROM usuario WHERE email = '" . $email . "'";
$statement = $pdo->prepare($sql);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);

// Resultado de la consulta
if ($result) {
    // Redireccionar al usuario a la página de registro con un mensaje de error
    header('Location: ../register.php?error=userAlreadyExists');
    exit;
} else {

    // Guardar los datos del usuario en la base de datos
    $sql = "INSERT INTO usuario (name, email, password) VALUES ('" . $name . "', '" . $email . "', '" . $password . "')";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    // Obtener el id del usuario
    $sql = "SELECT id FROM usuario WHERE email = '" . $email . "'";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($image['size'] > 0) {
        // Guardar la imagen en la carpeta de imágenes
        $imageName = 'Avatar_' . $result['id'] . '.jpg';
        move_uploaded_file($image['tmp_name'], '../public/images/avatars/' . $imageName);

        // Actualizar el campo image de la base de datos con el id del usuario
        $sql = "UPDATE usuario SET image = '" . $imageName . "' WHERE id = " . $result['id'];
        $statement = $pdo->prepare($sql);
        $statement->execute();
    }

    // Redireccionar al usuario a la página de inicio de sesión con un mensaje de éxito
    header('Location: ../index.php?success=userCreated');
    exit;
}
