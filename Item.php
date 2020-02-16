<?php


class Item
{
    private $id;
    private $localId;
    private $nome;
    private $descricao;
    private $codigo;
    private $data;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getLocalId()
    {
        return $this->localId;
    }

    public function setLocalId($localId)
    {
        $this->localId = $localId;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setDate($data)
    {
        $this->data = $data;
    }
}