<?php
session_start();
include_once("./views/templates/Header.php");
?>
<main class="card">
    <h1>CODO A CODO / CHAT</h1>
    <hr>
    <?php
    // Mostrar el mensaje de error si es que existe
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'emptyFields') {
            echo '<div class="error" role="alert">
                    <strong>¡Error!</strong> Debes rellenar todos los campos.
                  </div>';
        } else if ($_GET['error'] == 'wrongCredentials') {
            echo '<div class="error" role="alert">
                    <strong>¡Error!</strong> Tu email o contraseña no son correctas.
                  </div>';
        }
    }
    if (isset($_GET['success'])) {
        if ($_GET['success'] == 'userCreated') {
            echo '<div class="success" role="alert">
                    <strong>¡Bienvenido!</strong> Ya puedes iniciar sesión.
                  </div>';
        }
    }
    ?>
    <form class="form login" action="services/login.php" method="POST">
        <div class="field">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Tu correo electrónico" required>
        </div>
        <div class="field">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" placeholder="Tu contraseña" required>
        </div>
        <button type="submit">Iniciar Sesión</button>
        <small>
            <a href="register.php">
                ¿No tienes cuenta? Regístrate
            </a>
        </small>
    </form>
</main>
<?php
include_once("./views/templates/Footer.php");
?>