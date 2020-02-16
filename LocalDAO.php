<?php
    require_once 'PdoConnection.php';
class LocalDAO
{
    private $con;

    public function __construct()
    {
        $connection = new PdoConnection();
        $this->con = $connection->dbOpen();
    }


    public function cadastrar(Local $local) {
        $sql = "INSERT INTO " . PdoConnection::$DB . "." .  PdoConnection::$TABLE_LOCAL . "(nome) VALUES(:nome);";

        try {
            $insert = $this->con->prepare($sql);
            $insert->bindValue(":nome", $local->getNome());
            $insert->execute();
            return true;
        } catch (PDOException $e) {
            die("DB info: ERRO AO CADASTRAR LOCAL -> " . $e->getMessage());
            return false;
        }

    }

    public function editar(Local $local) {
        $sql = "UPDATE " . PdoConnection::$DB . "." . PdoConnection::$TABLE_LOCAL . " SET nome = :nome WHERE id = :id;";

        try {
            $update = $this->con->prepare($sql);
            $update->bindValue(":nome", $local->getNome());
            $update->bindValue(":id", $local->getId());
            $update->execute();
            return true;
        } catch (PDOException $e) {
            die("DB info: ERRO AO EDITAR LOCAL -> " . $e->getMessage());
            return false;
        }
    }

    public function excluir(Local $local) {
        $sql = "DELETE FROM " . PdoConnection::$DB . "." . PdoConnection::$TABLE_LOCAL . " WHERE id = :id;";

        try {
            $delete = $this->con->prepare($sql);
            $delete->bindValue(":id", $local->getId());
            $delete->execute();
            return true;
        } catch (PDOException $e) {
            die("DB info: ERRO AO EXCLUIR LOCAL -> " . $e->getMessage());
            return false;
        }
    }

    public function listar() {
        $sql = "SELECT * FROM " . PdoConnection::$DB . "." . PdoConnection::$TABLE_LOCAL . ";";

        try {
            $select = $this->con->prepare($sql);
            $select->execute();

            return $select->fetchAll();
            /*foreach ($select->fetchAll() as $l) {
                echo $l['id'] . " | ";
                echo $l['nome'] . "<br/>";
            }*/
        } catch (PDOException $e) {
            die("DB info: ERRO AO EXCLUIR LOCAL -> " . $e->getMessage());
            return false;
        }
    }
}