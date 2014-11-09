<?php

class day extends Model
{
    protected $_table = 'Day';
    protected $_idname = 'IdD';

    function is_valide_date($date, $sep = '-')
    {
        if(!strpos($date, $sep))
        {
            return false;
        }

        if(!list($year, $month, $day) = explode($sep, $date))
        {
            return false;
        }

        if($day > 31 OR $day < 1 OR $month > 12 OR $month < 1 OR $year > 2015 OR $year < 2014)
        {
            return false;
        }

        return checkdate($month, $day, $year);
    }

    function getDay(DateTime $date, $idUser)
    {
        $datestr = $date->format('Y-m-d');
        if(count($this->find(array('conditions' => 'DateD = \'' . $datestr . '\'' . 'AND IdU = ' . $idUser))) == 0)// vérifie si le day est déja présent
        {
            //echo '----- le jour n\'existe pas';
            $this->createDate($date, $idUser);
        }
        else
        {
            //echo '----- le jour existe';
        }
        // on affiche le jour
        $idd = $this->find(array('conditions' => 'DateD = \'' . $datestr . '\'' . 'AND IdU = ' . $idUser))[0]['IdD'];
        $connection = model::$connection;
        $stmt = $connection->prepare('SELECT NomA, NmH FROM Activity NATURAL JOIN  Hour WHERE IdD = ? ORDER BY NmH ASC');
        $stmt->execute(array($idd));
        $d = array();
        while($row = $stmt->fetch())
        {
            $d[$row['NmH']] = $row['NomA'];
        }
        //print_r($d);
        return $d;// retourne un tableau où la clé est l'heure et la valeur est l'activité
    }

    private function createDate(DateTime $date, $idu)
    {
        $connection = model::$connection;
        $daystart = 8;//h
        $dayfinish = 20;//h
        $dateFormat = $date->format('Y-m-d');
        $stmt1 = $connection->prepare('INSERT INTO Day(DateD, IdU) VALUES (?, ?)');
        $stmt1->execute(array($dateFormat, $idu));// on crée la journée

        $currentHour = $daystart;// on va remplire la journée de repos

        $stmt2 = $connection->prepare('INSERT INTO Hour (NmH, IdD, IdA) VALUES (:num, :idd, :ida)');
        $stmt2->bindParam(':num', $num);
        $stmt2->bindParam(':idd', $idd);
        $stmt2->bindParam(':ida', $ida);

        $ida = 4; // faudrait faire Select IdA from Activity Where NomA = 'repos' mais j'ai pas le courage

        $stmt3 = $connection->prepare('SELECT IdD FROM Day WHERE IdU = ? AND DateD = ?');
        $stmt3->execute(array($idu, $dateFormat));
        $idd = $stmt3->fetch()['IdD'];

        while($currentHour <= $dayfinish)
        {
            $num = $currentHour;

            $stmt2->execute();
            $currentHour++;
        }
    }

    function getActivitiesList()
    {
        $connection = model::$connection;
        $stmt = $connection->prepare('SELECT NomA, IdA FROM Activity');
        $stmt->execute();
        $d = array();
        while($row = $stmt->fetch())
        {
            $d[$row['IdA']] = $row['NomA'];
        }
        return $d;
    }

    function checkActivity($id_activity)
    {
        return $id_activity >= 1 && $id_activity <= 6 && gettype($id_activity) == "integer";
    }

    function checkHour($hour_number)
    {
        return $hour_number >= 8 && $hour_number <= 20 && gettype($hour_number) == "integer";
    }

    function changeActivity($id_user, $date, $hour_number, $id_activity)// faire toutes les vérifications avant
    {
        $dateobj = new DateTime($date);
        $dateFormat = $dateobj->format('Y-m-d');
        $stmt = model::$connection->prepare('UPDATE Hour SET IdA = :ida WHERE IdH = (SELECT * FROM (SELECT IdH FROM Hour NATURAL JOIN Day WHERE IdU = :idu AND DateD = :date AND NmH = :hour) AS t)');
        $stmt->bindParam(':ida', $id_activity, PDO::PARAM_INT);
        $stmt->bindParam(':idu', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':date', $dateFormat);
        $stmt->bindParam(':hour', $hour_number, PDO::PARAM_INT);
        $stmt->execute();

    }
}