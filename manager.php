<?php
session_start();
define('ROOT_PATH', './');
define('INCLUDES_PATH', ROOT_PATH.'includes/');
include INCLUDES_PATH . 'header.php'; ?>
<section id="manager-section">
<p><?php echo 'Bonjour '.$_SESSION['prenom'].' '.$_SESSION['nom'] ?></p><a href="./disconnect.php">deconnection</a>
</section>
<?php include INCLUDES_PATH . 'footer.php'; ?>
