<?php
include_once "class/Conexao.php";
include_once "class/Funcoes.php";

class CidadeDao{
  private $con;
  private $objfc;
  private $idcidade;


  public function __construct(){
        $this->con =  new Conexao();
        $this->objfc = new Funcoes();
    }

 public function querySeleciona($dado){
        try{
            $this->idEstado = $this->objfc->base64($dado, 2);
            $cst = $this->con->conectar()->prepare("SELECT idcidade, nome, estado_id FROM `cidade` WHERE `idcidade` = :idcidade;");
            $cst->bindParam(":idcidade", $this->idcidade, PDO::PARAM_INT);
            $cst->execute();
            return $cst->fetch();
        } catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }

    public function querySelect(){
        try{
            $cst = $this->con->conectar()->prepare("SELECT `idcidade`, `nome`, `estado_id` FROM `cidade`;");
            $cst->execute();
            return $cst->fetchAll();
        } catch (PDOException $ex) {
            return 'erro '.$ex->getMessage();
        }
    }

    public function queryInsert($dados){
        try{
            $this->nome = $this->objfc->tratarCaracter($dados['nome'], 1);
            $this->estado_id = $dados['estado_id'];
            //$this->senha = sha1($dados['sigla']);
            //$this->dataCadastro = $this->objfc->dataAtual(2);
            $cst = $this->con->conectar()->prepare("INSERT INTO `cidade` (`nome`, `estado_id`) VALUES (:nome, :estado_id);");
            $cst->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $cst->bindParam(":estado_id", $this->estado_id, PDO::PARAM_STR);
            if($cst->execute()){
                return 'ok';
            }else{
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }

    public function queryUpdate($dados){
        try{
            $this->idEstado= $dados['est'];
            $this->nome = $this->objfc->tratarCaracter($dados['nome'], 1);
            $this->sigla = $dados['sigla'];
            $cst = $this->con->conectar()->prepare("UPDATE `estado` SET  `nome` = :nome, `estado_id` = :estado_id WHERE `idcidade` = :idcidade;");
            $cst->bindParam(":idcidade", $this->idEstado, PDO::PARAM_INT);
            $cst->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $cst->bindParam(":estado_id", $this->estado_id, PDO::PARAM_STR);
            if($cst->execute()){
                return 'ok';
            }else{
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }

    public function queryDelete($dado){
        try{
            $this->idEstado = $this->objfc->base64($dado,2);
            $cst = $this->con->conectar()->prepare("DELETE FROM `cidade` WHERE `idcidade` = :idcidade;");
            $cst->bindParam(":idcidade", $this->idcidade, PDO::PARAM_INT);
            if($cst->execute()){
                return 'ok';
            }else{
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error'.$ex->getMessage();
        }
    }
}
