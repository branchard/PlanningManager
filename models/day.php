<?php

class day extends Model
{
    protected $_table = 'Day';
    protected $_idname = 'IdD';

    function is_valide_date($date, $sep = '-')
    {
        if (!strpos($date, $sep))
        {
            return false;
        }

        if (!list($year, $month, $day) = explode($sep, $date))
        {
            return false;
        }

        if ($day > 31 OR $day < 1 OR $month > 12 OR $month < 1 OR $year > 2015 OR $year < 2014)
        {
            return false;
        }

        return checkdate($month, $day, $year);
    }

    function getDay(DateTime $date, $idUser)
    {
        $datestr = $date->format('Y-m-d');
        if (count($this->find(array('conditions' => 'DateD = \'' . $datestr . '\'' . 'AND IdU = ' . $idUser))) == 0)// vérifie si le day est déja présent
        {
            echo '----- le jour n\'existe pas';
            $this->createDate($date, $idUser);
        }
        else{
            echo '----- le jour existe';
        }
        // on affiche le jour
        $idd = $this->find(array('conditions' => 'DateD = \'' . $datestr . '\'' . 'AND IdU = ' . $idUser))[0]['IdD'];
        print_r($this->find(array('conditions' => 'DateD = \'' . $datestr . '\'' . 'AND IdU = ' . $idUser)));
        echo $idd;
        $connection = model::$connection;
        $stmt = $connection->prepare('select NomA, NmH from Activity natural join  Hour where IdD = ?');
        $stmt->execute(array($idd));
        while ($row = $stmt->fetch()) {
            echo '<p>'.$row['NmH'].'h - '.$row['NomA'].'</p>';
        }
    }

    private function createDate(DateTime $date, $idu)
    {
        $connection = model::$connection;
        $daystart = 8;//h
        $dayfinish = 20;//h
        $dateFormat = $date->format('Y-m-d');
        $stmt1 = $connection->prepare('INSERT INTO Day(DateD, IdU) VALUES (?, ?)');
        $stmt1->execute(array($dateFormat, $idu));// on crée la journée
        echo $dateFormat;

        $currentHour = $daystart;// on va remplire la journée de repos

        $stmt2 = $connection->prepare('INSERT INTO Hour (NmH, IdD, IdA) VALUES (:num, :idd, :ida)');
        $stmt2->bindParam(':num', $num);
        $stmt2->bindParam(':idd', $idd);
        $stmt2->bindParam(':ida', $ida);

        $ida = 4; // faudrait faire Select IdA from Activity Where NomA = 'repos' mais j'ai pas le courage

        $stmt3 = $connection->prepare('SELECT IdD FROM Day WHERE IdU = ? AND DateD = ?');
        $stmt3->execute(array($idu, $dateFormat));
        $idd = $stmt3->fetch()['IdD'];

        while ($currentHour <= $dayfinish)
        {
            $num = $currentHour;

            $stmt2->execute();
            $currentHour++;
        }
    }

}