<?php
class DB
{
    public function __construct(string $hostname, string $db, string $username = null, string $password = null)
    {
        return $this->connect($hostname, $db, $username, $password);
    }

    public function __destruct()
    {
        $this->db = null;
    }

    private function connect(string $hostname, string $db, string $user, string $password)
    {
        $dsn="mysql:host={$hostname};dbname={$db}";
        try {
            $this->db = new PDO($dsn, $username, $password);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception($e);
        }
        return $this->db;
    }

    public function run($sql, $args = [])
    {
        return $this->prepare($sql, $args);
    }
    
    private function prepare($sql, $args) {
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute($args);
        } catch (PDOException $e) {
            throw new Exception($e);
        }
        return $stmt;
    }

    public function get($sql, $args = [])
    {
        $stmt = $this->prepare($sql, $args);
        try {
            $res = $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception($e);
        }
        return $res;
    }
    
    public function getOne($sql, $args = []) {
        $stmt = $this->prepare($sql, $args);
        try {
            $res = $stmt->fetchObject();
        } catch (PDOException $e) {
            throw new Exception($e);
        }
        return $res;
    }
}
