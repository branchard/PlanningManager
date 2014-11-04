<?php
session_start();
define('ROOT_PATH', './');
define('INCLUDES_PATH', ROOT_PATH . 'includes/');
require INCLUDES_PATH . 'connect.php';
include INCLUDES_PATH . 'header.php';
?>

<script type="text/javascript">
                $(function() {
                $("#datepicker" ).datepicker({
                beforeShowDay: function(date){
                var b = (date.getDay() >0);
                var c = "";
                if (!b) {
                    c = "ui-state-disabled";
                }
         
                d = new Date(2014, 11, 24)
                if ((date >= d) && (date <= d)) {
                    c = "ui-event";
                }
                return [b, c];
                }
      });
   });
   </script>

<?php

if (isset($_SESSION['id'])) {
    // CONSTANTES
    define('DAYSTART', 8);//heure de commancement de la journée
    define('DAYFINISH', 20);//heure de fib de journée

    function datePickerInsert()
    {
        ?>
            <form method="post" action="manager.php">
            <p>
                <label for="date">Veuillez entrer une journée à inserer:</label>
                <!--<input type="date" name="date">-->
                <input type="date" id="datepicker" name="date"></p>
            </p>

            <p>
                <button type="submit">Go</button>
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
                    while ($row = $stmt->fetch()) {
                        echo '<OPTION>' . $row['DateD'];
                    }
                    ?>
                </select>
            </p>

            <p>
                <button type="submit">Go</button>
            </p>
        </form>
    <?php
    }

    if (isset($_POST['date']) && $_POST['date'] != '') {
		
        $dateFormat = date("Y-m-d", strtotime($_POST['date']));
        echo 'Vous voullez inserer la date ' . $dateFormat;
        $stmt0 = $connection->prepare('SELECT COUNT(*) FROM Day WHERE IdU = ? and DateD = ?');
        $stmt0->execute(array($_SESSION['id'], $dateFormat));
        if ($stmt0->fetch()['COUNT(*)'] > 0) {// teste si la journé existe déja
            echo 'la date existe déja';
        } else {
            echo ' la date n\'existe pas';
            $stmt1 = $connection->prepare('INSERT INTO Day(DateD, IdU) VALUES (?, ?)');
            $stmt1->execute(array($dateFormat, $_SESSION['id']));// on crée la journée

            $currentHour = DAYSTART;// on va remplire la journée de repos

            $stmt2 = $connection->prepare('INSERT INTO Hour (NmH, IdD, IdA) VALUES (:num, :idd, :ida)');
            $stmt2->bindParam(':num', $num);
            $stmt2->bindParam(':idd', $idd);
            $stmt2->bindParam(':ida', $ida);

            $ida = 4; // faudrait faire Select IdA from Activity Where NomA = 'repos';

            $stmt3 = $connection->prepare('Select IdD from Day where IdU = ? and DateD = ?');
            $stmt3->execute(array($_SESSION['id'], $dateFormat));
            $idd = $stmt3->fetch()['IdD'];

            while ($currentHour <= DAYFINISH) {
                $num = $currentHour;

                $stmt2->execute();
                $currentHour++;
            }
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
        } else {
            echo 'vous avez des journées de définit';
            datePickerSelect($connection);
            datePickerInsert();
        }
        if (isset($_GET['displaydate']) && $_GET['displaydate'] != '') {
            echo '<p>Affichage du '.$_GET['displaydate'].'</p>';
            $stmt4 = $connection->prepare('select NomA from Activity natural join  Hour where IdD = (Select IdD from Day where DateD = ? and IdU = ?)');
            $stmt4->execute(array($_GET['displaydate'] ,$_SESSION['id']));
            $currentHour = DAYSTART;
            while ($row = $stmt4->fetch()) {
                echo '<p>'.$currentHour.'h - '.$row['NomA'].'</p>';
                $currentHour++;
            }
        }
        ?>
    </section>
    <?php include INCLUDES_PATH . 'footer.php';
} else {
    header('Location: ./');
}
?>
