<?php
require '../conexion.php';

session_start();

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
    header('Location: ../update.php?error=emptyFields');
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

// Validar que el email no este en uso por otro usuario
$sql = "SELECT * FROM usuario WHERE email = '" . $email . "'";
$statement = $pdo->prepare($sql);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);

if ($result) {
    if ($result['id'] != $_SESSION['user']['id']) {
        header('Location: ../update.php?error=userAlreadyExists');
        exit;
    }
}

// Actualizar los datos del usuario en la base de datos
$sql = "UPDATE usuario SET name = '" . $name . "', email = '" . $email . "', password = '" . $password . "' WHERE id = " . $_SESSION['user']['id'];
$statement = $pdo->prepare($sql);
$statement->execute();

// Actualizar los datos del usuario en la sesión
$_SESSION['user']['name'] = $name;
$_SESSION['user']['email'] = $email;
$_SESSION['user']['password'] = $password;

if ($_SESSION['user']['image'] != null && $image['size'] > 0) {
    // Sobreescribir la imagen en la carpeta de imágenes
    $imageName = 'Avatar_' . $_SESSION['user']['id'] . '.jpg';
    move_uploaded_file($image['tmp_name'], '../public/images/avatars/' . $imageName);

    // Actualizar el campo image de la base de datos con el id del usuario
    $sql = "UPDATE usuario SET image = '" . $imageName . "' WHERE id = " . $_SESSION['user']['id'];
    $statement = $pdo->prepare($sql);
    $statement->execute();

    // Actualizar el campo image de la sesión con el id del usuario
    $_SESSION['user']['image'] = $imageName;
}


// Redireccionar al usuario a la página de perfil con un mensaje de éxito
header('Location: ../profile.php?success=userUpdated');
exit;
