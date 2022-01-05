<?php
require "./services/retringed.php";
require "./services/checkUsers.php";
include_once("./views/templates/Header.php");
?>
<main class="card list">
    <header>
        <figure>
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
            <div>
                <a href="profile.php">
                    <h2>
                        <?php echo $User->getName() ?>
                    </h2>
                </a>
                <p>Activo ahora</p>
            </div>
        </figure>
        <div class="buttons">
            <a class="refresh" href="./user.php">
                <span class="material-icons">
                    refresh
                </span>
            </a>
            <a class="logout" href="./services/logout.php">
                <span class="material-icons">
                    exit_to_app
                </span>
            </a>
        </div>
    </header>
    <hr>
    <section class="search">
        <label for="selectChat">Inicia una conversacion con alguien.</label>
        <input type="text" name="selectChat" id="selectChat" placeholder="Ingresa el nombre a buscar">
        <button>
            <span class="material-icons">search</span>
        </button>
    </section>
    <section class="chats">
        <?php
        if (count($Users) > 1) {
            foreach ($Users as $Contact) {
                if ($Contact->getId() != $User->getId()) {
        ?>
                    <a href="chat.php?id=<?php echo $Contact->getId() ?>" class="chat">
                        <figure>
                            <?php
                            if ($Contact->getImage() != "") {
                            ?>
                                <img src="public/images/avatars/<?php echo $Contact->getImage() ?>" alt="foto de perfil de <?php echo $Contact->getName() ?>">
                            <?php
                            } else {
                            ?>
                                <img src="public/images/avatars/unknown-user.jpg" alt="foto de perfil de <?php echo $Contact->getName() ?>">
                            <?php
                            }
                            ?>
                            <div>
                                <h3>
                                    <?php echo $Contact->getName() ?>
                                </h3>
                                <p>Este es un mensaje de prueba</p>
                            </div>
                        </figure>
                        <span class="material-icons status">
                            circle
                        </span>
                    </a>
            <?php
                }
            }
        } else {
            ?>
            <p>No hay contactos para mostrar 😔</p>
        <?php
        }
        ?>
    </section>
</main>
<script src="./public/js/users.js"></script>
<?php
include_once("./views/templates/Footer.php");
?>