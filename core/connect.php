<?php

class connect extends Database
{
    function getConnection()
    {
        try
        {
            $connection = new PDO($this->default['datasource'] . ':host=' . $this->default['host'] . ';dbname=' . $this->default['database'], $this->default['login'], $this->default['password'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            if (Configure::$debug_mode === 2)
            {
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            }
            elseif (Configure::$debug_mode === 1)
            {
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            else
            {
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
            }
        }
        catch (Exception $e)
        {
            echo "Connection à MySQL impossible : ", $e->getMessage();
            die();
        }

        return $connection;
    }
}
