<?php
session_start();
define('ROOT_PATH', './');
define('INCLUDES_PATH', ROOT_PATH . 'includes/');
require INCLUDES_PATH . 'connect.php';
include INCLUDES_PATH . 'header.php';
if (isset($_SESSION['id'])) {
    function datePickerInsert()
    {
        ?>
        <form method="post" action="manager.php">
            <p>
                <label for="date">Veuillez entrer une journée à inserer:</label>
                <input type="date" name="date">
            </p>
            <p>
                <button type="submit" >Go</button>
            </p>
        </form>
        <?php
    }

    function datePickerSelect($connection)
    {
        ?>
        <form method="get" action="manager.php">
            <p>
                <label for="date">Veuillez selectionner une journée à afficher:</label>
                <select name="displaydate" size="1">
                    <?php
                    $stmt = $connection->prepare('SELECT DateD FROM Day WHERE IdU = ?');
                    $stmt->execute(array($_SESSION['id']));
                    while($row = $stmt->fetch())
                    {
                        echo '<OPTION>' . $row['DateD'];
                    }
                    ?>
                </select>
            </p>
            <p>
                <button type="submit" >Go</button>
            </p>
        </form>
    <?php
    }
    if(isset($_POST['date']) && $_POST['date'] != '')
    {
        // il faut tester si la date est une date valide

        $dateFormat = date($_POST['date']);
        echo 'Vous voullez inserer la date '.$dateFormat;
        $stmt0 = $connection->prepare('SELECT COUNT(*) FROM Day WHERE IdU = ? and DateD = ?');
        $stmt0->execute(array($_SESSION['id'], $dateFormat));
        if ($stmt0->fetch()['COUNT(*)'] > 0) {// teste si la journé existe déja
            echo 'la date existe déja';
        }
        else {
            echo 'la date n\'existe pas';
            $stmt1 = $connection->prepare('INSERT INTO Day(DateD, IdU) VALUES (?, ?)');
            $stmt1->execute(array($dateFormat, $_SESSION['id']));
        }
    }
    ?>
    <section id="manager-section">
        <div id="login-info">
            <p><?php echo 'Bonjour ' . $_SESSION['prenom'] . ' ' . $_SESSION['nom'] ?></p>

            <p>[</p><a href="./logout.php">deconnection</a>

            <p>]</p>
        </div>
        <?php
        $prepare_statement = $connection->prepare('SELECT COUNT(*) FROM Day WHERE IdU = ?');
        $prepare_statement->execute(array($_SESSION['id']));
        if ($prepare_statement->fetch()['COUNT(*)'] == 0) {
            ?>
        <p>Il semble que vous n'ayez pas encore déffinit de journée</p>
        <?php
            datePickerInsert();
        }
        else
        {
            echo 'vous avez des journées de définit';
            datePickerSelect($connection);
            datePickerInsert();
        }
        ?>
    </section>
    <?php include INCLUDES_PATH . 'footer.php';
} else {
    header('Location: ./');
}
?>
