<?php
include_once "class/Conexao.php";
include_once "class/Funcoes.php";
include_once "dao/CidadeDao.php";

class Cidade extends CidadeDao{

  private $nome;
  private $estado_id;
  public $dao;


  public function __construct(){
        $this->dao =  new CidadeDao();
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    public function __get($atributo){
        return $this->$atributo;
    }


}


