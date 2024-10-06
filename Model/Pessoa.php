<?php

class Pessoa
{
    private $id;
    private $nome;
    private $filhos;

    public function __construct($nome, $filhos = [])
    {
        $this->nome = $nome;
        $this->filhos = $filhos;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getFilhos()
    {
        return $this->filhos;
    }

    public function setFilhos($filhos)
    {
        $this->filhos = $filhos;
    }
}
