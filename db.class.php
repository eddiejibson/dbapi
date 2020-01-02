<?php
class DB
{
    public function __construct(array $conn = []) //I will be getting this from the config file

    {
        return $this->connect(($conn["hostname"] ?? "127.0.0.1"), ($conn["database"] ?? "bother"), ($conn["username"] ?? "bother"), $conn["password"]);
    }

    public function __destruct()
    {
        $this->db = null;
    }

    private function connect(string $hostname, string $db, string $username, string $password)
    {
        $dsn = "mysql:host={$hostname};dbname={$db}";
        try {
            $this->db = new PDO($dsn, $username, $password);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->db->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
        } catch (PDOException $e) { //All exceptions I am just catching and throwing, intending on perhaps handling it differently later (instead of just handling all exceptions the same way in the utils class)
            throw new Exception($e);
        }
        return $this->db;
    }

    public function run($sql, $args = [], $getId = false) //May need ID if for example collection creation is in same script as when it is referenced (user cannot submit)

    {
        return $this->prepare($sql, $args, $getId);
    }

    private function prepare($sql, $args, $getId = false)
    {
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute($args);
        } catch (PDOException $e) {
            throw new Exception($e);
        }
        if ($getId) {
            return (int) $this->db->lastInsertId();
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

    public function getOne($sql, $args = [])
    {
        $stmt = $this->prepare($sql, $args);
        try {
            $res = $stmt->fetchObject();
        } catch (PDOException $e) {
            throw new Exception($e);
        }
        return $res;
    }
}
