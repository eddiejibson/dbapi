<?php
class db
{
    public function __construct()
    {
        $this->connect();
    }

    public function __destruct()
    {
        $this->db = null;
    }

    private function connect()
    {
        //CHANGE DATABASE INFORMATION HERE
        $host = "localhost"; //Database hostname. If unsure, leave it how it is.
        $user = ""; //Database username
        $pass = ""; //Database password
        $db = ""; //Database name
        //If you're not sure what this does, leave it. Should work fine as it is.
        $dsn="mysql:host={$host};dbname={$db}";
        try {
            $this->db = new PDO($dsn, $user, $pass);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
            // die();
        }
    }

    public function runQuery($sql, $args = [])
    {
        $count = $this->db->prepare($sql);
        try {
            $count = $count->execute($args);
        } catch (PDOException $e) {
            echo $e->getMessage();
            //die();
        }
        return $count;
    }

    public function getQuery($sql, $args = [])
    {
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute($args);
            $res = $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            // die();
        }
        return $res;
    }
}

$db = new db();
