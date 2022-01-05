<?php
require "./services/retringed.php";
include_once("./views/templates/Header.php");
?>
<main class="card">
    <h1>Modificiando al usuario #<?php echo $User->getId() ?></h1>
    <hr>
    <?php
    // Mostrar el mensaje de error si es que existe
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'emptyFields') {
            echo '<div class="error" role="alert">
                    <strong>¡Error!</strong> Debes rellenar todos los campos.
                  </div>';
        } else if ($_GET['error'] == 'userAlreadyExists') {
            echo '<div class="error" role="alert">
                    <strong>¡Error!</strong> El usuario ya existe.
                  </div>';
        }
    }
    ?>
    <form class="form register" method="POST" action="services/updateUser.php" enctype="multipart/form-data">
        <div class="field">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" placeholder="Tu nombre completo" value="<?php echo $User->getName(); ?>" required>
        </div>
        <div class="field">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Tu correo electrónico" value="<?php echo $User->getEmail(); ?>" required>
        </div>
        <div class="field">
            <label for="image">Imagen:</label>
            <input type="file" name="image" id="image" value="<?php echo $User->getImage(); ?>">
        </div>
        <div class="field">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" placeholder="Tu contraseña" required>
        </div>
        <div class="field">
            <label for="repassword">Repetir Contraseña:</label>
            <input type="password" name="repassword" id="repassword" placeholder="Repite tu contraseña" required>
        </div>
        <button type="submit">
            Actualizar Perfil
        </button>
    </form>
    <small>
        <a href="profile.php">
            Cancelar y volver
        </a>
    </small>
</main>
<?php
include_once("./views/templates/Footer.php"); ?>