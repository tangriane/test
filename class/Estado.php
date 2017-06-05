<?php
include_once "class/Conexao.php";
include_once "class/Funcoes.php";
include_once "dao/EstadoDao.php";

class Estado extends EstadoDao{

  private $nome;
  private $sigla;
  public $dao;


  public function __construct(){
        $this->dao =  new EstadoDao();
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    public function __get($atributo){
        return $this->$atributo;
    }


}


