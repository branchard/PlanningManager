<?php

class Model
{
    protected static $connection;// connection PDO
    protected $_table;
    public $_id;
    protected $_idname;

    static public function setConnection(PDO $connection)
    {
        model::$connection = $connection;// connection PDO, il faut la définir pour se servire des autres méthodes
    }

    public function read($field = null)
    {
        if ($field == null)
        {
            $field = "*";
        }
        $stmt = model::$connection->prepare("SELECT $field FROM $this->_table WHERE $this->_idname = :id");
        $stmt->bindParam(':id', $this->_id, PDO::PARAM_INT);
        try
        {
            $stmt->execute();
        }
        catch (PDOException $e)
        {
            echo 'Erreur PDO : ' . $e->getMessage();
            die();
        }
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data[0] as $k => $v)//TODO
        {
            $this->$k = $v;
        }
    }

    public function save($data)
    {
        if (isset($data["id"]) && !empty($data["id"]))
        {
            $sql = "UPDATE " . $this->_table . " SET ";
            foreach ($data as $k => $v)
            {
                if ($k != "id")
                {
                    $sql .= "$k='$v',";
                }
            }
            $sql = substr($sql, 0, -1);
            $sql .= " WHERE id=" . $data["id"];
        }
        else
        {
            $sql = "INSERT INTO " . $this->_table . " (";
            unset($data["id"]);
            foreach ($data as $k => $v)
            {
                $sql .= "$k,";
            }
            $sql = substr($sql, 0, -1);

            $sql .= ") VALUES (";
            foreach ($data as $v)
            {
                $sql .= "'$v',";
            }
            $sql = substr($sql, 0, -1);
            $sql .= ")";
        }
        $stmt = model::$connection->prepare($sql);
        try
        {
            $stmt->execute();
        }
        catch (PDOException $e)
        {
            echo 'Erreur PDO : ' . $e->getMessage();
            die();
        }
    }

    public function find($data = array())
    {
        $conditions = "1 = 1";
        $fields = "*";
        $limit = "";
        $order = $this->_idname . " DESC";
        if (isset($data["conditions"]))
        {
            $conditions = $data["conditions"];
        }
        if (isset($data["fields"]))
        {
            $fields = $data["fields"];
        }
        if (isset($data["limit"]))
        {
            $limit = "LIMIT " . $data["limit"];
        }
        if (isset($data["order"]))
        {
            $order = $data["order"];
        }

        $stmt = model::$connection->prepare("SELECT $fields FROM $this->_table WHERE $conditions ORDER BY $order $limit");
        try
        {
            $stmt->execute();
        }
        catch (PDOException $e)
        {
            echo 'Erreur PDO : ' . $e->getMessage();
            die();
        }
        $d = array();
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $d[] = $data;
        }
        return $d;
    }

    /*public function del($id = null)
    {

    }*/

    static function load($name)
    {
        require("$name.php");
        return new $name;
    }
}

?>