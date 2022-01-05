<?php
include "./services/retringed.php";
if (!isset($_GET['id'])) {
    header('Location: user.php');
    exit;
}

$incomingUser = new User();
$incomingUser->getByID($_GET['id']);

include_once("./views/templates/Header.php");

?>
<main class="card chat-area">
    <header>
        <a href="user.php">
            <span class="material-icons">
                arrow_back
            </span>
        </a>
        <figure>
            <?php
            if ($incomingUser->getImage() != "") {
            ?>
                <img src="public/images/avatars/<?php echo $incomingUser->getImage() ?>" alt="foto de perfil de <?php echo $incomingUser->getName() ?>">
            <?php
            } else {
            ?>
                <img src="public/images/avatars/unknown-user.jpg" alt="foto de perfil de <?php echo $incomingUser->getName() ?>">
            <?php
            }
            ?>
            <div>
                <h2>
                    <?php
                    echo $incomingUser->getName()
                    ?>
                </h2>
                <p>
                    <?php
                    if ($incomingUser->getLastActivity()->getTimestamp() > (time() - 120)) {
                        echo "Activo ahora";
                    } else {
                        // colocar hacer cuantos minutos hace que se conecto
                        echo "Activo hace " . round((time() - $incomingUser->getLastActivity()->getTimestamp()) / 60) . " minutos";
                    }
                    ?>
                </p>
            </div>
        </figure>
    </header>
    <div class="chat-box">
    </div>
    <form id="chat-form" action="services/sendMessages.php" class="typing-area" method="POST">
        <input type="hidden" name="receiver" value="<?php echo $incomingUser->getId() ?>">
        <input type="text" name="message" id="message" placeholder="Escribe tu mensaje" autocomplete="off">
        <button type="submit">
            <span class="material-icons">
                send
            </span>
        </button>
    </form>
</main>
<script src="./public/js/chat.js"></script>
<?php
include_once("./views/templates/Footer.php");
?>