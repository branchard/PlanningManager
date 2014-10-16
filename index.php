<?php
session_start();
define('ROOT_PATH', './');
define('INCLUDES_PATH', './includes/');
if(!isset($_SESSION['id']))
{
include INCLUDES_PATH . 'header.php'; ?>
<section id="login-form-section">
    <?php
    if (isset($_GET['reason'])) {
        echo '<div id="login_reason_info_wrapper"><p id="login_reason_info">';
        switch ($_GET['reason']) {
            case 'login_missed':
                echo 'Vous devez rentrer un login et un password';
                break;
            case 'login_bad':
                echo 'Mauvais login ou password';
                break;
            default:
                echo 'Erreur inconue';
        }
        echo '</p></div>';
    }
    ?>
    <form id="main-login" method="post" action="login.php" class="login">
        <p>
            <label for="login">Username:</label>
            <input type="text" name="login" id="login" placeholder="Jean Mouloude"><!-- Faudrait que le place holder disparraisse au clic -->
        </p>

        <p>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="MotDePasse">
        </p>

        <p class="login-submit">
            <button type="submit" class="login-button">Login</button>
        </p>
    </form>
</section>
<?php include INCLUDES_PATH . 'footer.php';
}
else
{
    header('Location: ./manager.php');
}
?>