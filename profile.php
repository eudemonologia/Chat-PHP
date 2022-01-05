<?php
require "./services/retringed.php";
include_once("./views/templates/Header.php");
?>
<main class="card perfil">
    <header>
        <a href="user.php">
            <span class="material-icons">
                arrow_back
            </span>
        </a>
        <figure>
            <h2>
                <?php echo $User->getName() ?>
            </h2>
            <?php
            if ($User->getImage() != "") {
            ?>
                <img src="public/images/avatars/<?php echo $User->getImage() ?>" alt="foto de perfil de <?php echo $User->getName() ?>">
            <?php
            } else {
            ?>
                <img src="public/images/avatars/unknown-user.jpg" alt="foto de perfil de <?php echo $User->getName() ?>">
            <?php
            }
            ?>
        </figure>
        <a href="mailto:<?php echo $User->getEmail() ?>">
            <span class="material-icons">
                email
            </span>
        </a>
    </header>
    <div class="buttons">
        <a href="update.php" onclick="return confirm('¿Estás seguro de que quieres actualizar tus datos?') ? true : false">
            <button class="edit">
                Modificar
            </button>
        </a>
        <a href="services/deleteUser.php" onclick="return confirm('¿Estás seguro de que quieres eliminar tu cuenta?') ? true : false">
            <button class="delete">
                Eliminar
            </button>
        </a>
    </div>
</main>
<?php
include_once("./views/templates/Footer.php");
?>