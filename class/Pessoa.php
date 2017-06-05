<?php
include_once "Conexao.php";
include_once "Funcoes.php";

class Pessoa{
  private $con;
  private $objfc;
  private $idPessoa;
  private $nome;
  private $endereco;

  public function __construct(){
        $this->con =  new Conexao();
        $this->objfc = new Funcoes();
    }
