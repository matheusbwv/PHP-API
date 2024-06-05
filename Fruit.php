<?php
class Fruit{
    private $id;
    private $nome;
    private $quantidade;

    public function __construct($nome, $quantidade){
        $this->nome = $nome;
        $this->quantidade = $quantidade;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getQuantidade(){
        return $this->quantidade;
    }

    public function setGenero($quantidade){
        $this->quantidade = $quantidade;
    }

}