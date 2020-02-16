<?php

class PdoConnection
{
    private $host = "localhost:3308";
    private $user = "root";
    private $pass = "";
    private $dsn;
    private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

    public static $DB = "amox";
    public static $TABLE_LOCAL = "local";
    public static $TABLE_ITEM = "item";

    public final function dbOpen() {
        $this->dsn =  "mysql:host={$this->host};";

        $sqlDB = "CREATE DATABASE IF NOT EXISTS " . self::$DB . ";";

        $sqlTable1 = "CREATE TABLE IF NOT EXISTS " . self::$DB . "." . self::$TABLE_LOCAL .
            "(id INTEGER PRIMARY KEY AUTO_INCREMENT, nome TEXT NOT NULL);";

        $sqlTable2 = "CREATE TABLE  IF NOT EXISTS " . self::$DB . "." . self::$TABLE_ITEM .
            "(id INTEGER PRIMARY KEY AUTO_INCREMENT, local_id integer NOT NULL, nome TEXT NOT NULL, descricao TEXT NOT NULL, codigo TEXT, data DATE," .
            " FOREIGN KEY (local_id) REFERENCES " . self::$TABLE_LOCAL . "(id)); ";

        //connection server
        try {
            $con = new PDO($this->dsn, $this->user, $this->pass, $this->options);
        } catch (PDOException $e) {
            die("DB info: ERRO AO ABRIR CONEXÃO -> " . $e->getMessage());
            return false;
        }

        //create DB and tables
        if ($con) {
            try {
                $con->exec($sqlDB);
                $con->exec($sqlTable1);
                $con->exec($sqlTable2);
            } catch (PDOException $e) {
                die("DB info: ERRO AO CRIAR BASE DE DADOS -> " . $e->getMessage());
                return false;
            }
        }

        return $con;
    }
}