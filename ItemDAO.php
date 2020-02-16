<?php
    require_once 'PdoConnection.php';
class ItemDAO
{
    private $con;

    public function __construct()
    {
        $connection = new PdoConnection();
        $this->con = $connection->dbOpen();
    }


    public function cadastrar(Item $item) {
        $sql = "INSERT INTO " . PdoConnection::$DB . "." .  PdoConnection::$TABLE_ITEM . "(local_id, nome, descricao, codigo, data)
                VALUES(:localId, :nome, :descricao, :codigo, :data);";

        try {
            $insert = $this->con->prepare($sql);
            $insert->bindValue(":localId", $item->getLocalId());
            $insert->bindValue(":nome", $item->getNome());
            $insert->bindValue(":descricao", $item->getDescricao());
            $insert->bindValue(":codigo", $item->getCodigo());
            $insert->bindValue(":data", $item->getData());
            $insert->execute();
            return true;
        } catch (PDOException $e) {
            die("DB info: ERRO AO CADASTRAR ITEM -> " . $e->getMessage());
            return false;
        }

    }

    public function editar(Item $item) {
        $sql = "UPDATE " . PdoConnection::$DB . "." . PdoConnection::$TABLE_ITEM . " SET nome = :nome, descricao = :descricao, codigo = :codigo
         WHERE id = :id;";

        try {
            $update = $this->con->prepare($sql);
            $update->bindValue(":id", $item->getId());
            $update->bindValue(":nome", $item->getNome());
            $update->bindValue(":descricao", $item->getDescricao());
            $update->bindValue(":codigo", $item->getCodigo());
            $update->execute();
            return true;
        } catch (PDOException $e) {
            die("DB info: ERRO AO EDITAR ITEM -> " . $e->getMessage());
            return false;
        }
    }

    public function excluir(Item $item) {
        $sql = "DELETE FROM " . PdoConnection::$DB . "." . PdoConnection::$TABLE_ITEM . " WHERE id = :id;";

        try {
            $delete = $this->con->prepare($sql);
            $delete->bindValue(":id", $item->getId());
            $delete->execute();
            return true;
        } catch (PDOException $e) {
            die("DB info: ERRO AO EXCLUIR ITEM -> " . $e->getMessage());
            return false;
        }
    }

    public function listar() {
        $sql = "SELECT * FROM " . PdoConnection::$DB . "." . PdoConnection::$TABLE_ITEM . ";";

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