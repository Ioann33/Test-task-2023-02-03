<?php

namespace Models;

class Model
{
    public $db;
    protected string $db_name;
    protected string $db_host;
    protected string $db_user;
    protected string $db_password;

    public function __construct()
    {
        $this->db_name = DB_NAME;
        $this->db_host = DB_HOST;
        $this->db_user = DB_USER;
        $this->db_password = DB_PASS;
        $this->db = new \PDO("pgsql:dbname=$this->db_name;host=$this->db_host;", $this->db_user, $this->db_password,
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]);
    }

    public function beginTransaction(){
        $sql = "BEGIN;";
        return $this->db->query($sql);
    }

    public function commit(){
        $sql = "COMMIT;";
        return $this->db->query($sql);
    }

    public function rollBack(){
        $sql = "ROLLBACK;";
        return $this->db->query($sql);
    }
}