<?php
include_once "class/Conexao.php";
include_once "class/Funcoes.php";

class EstadoDao{
  private $con;
  private $objfc;
  private $idEstado;


  public function __construct(){
        $this->con =  new Conexao();
        $this->objfc = new Funcoes();
    }

 public function querySeleciona($dado){

        try{
            $this->idEstado = $this->objfc->base64($dado, 2);
            $cst = $this->con->conectar()->prepare("SELECT idEstado, nome, sigla FROM `estado` WHERE `idEstado` = :idEstado;");
            $cst->bindParam(":idEstado", $this->idEstado, PDO::PARAM_INT);
            $cst->execute();
            return $cst->fetch();
        } catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }

    public function querySelect(){

        try{
            $cst = $this->con->conectar()->prepare("SELECT `idEstado`, `nome`, `sigla` FROM `estado`;");
            $cst->execute();
            return $cst->fetchAll();
        } catch (PDOException $ex) {
            return 'erro '.$ex->getMessage();
        }
    }

    public function queryInsert($dados){
        try{
            $this->nome = $this->objfc->tratarCaracter($dados['nome'], 1);
            $this->sigla = $dados['sigla'];
            //$this->senha = sha1($dados['sigla']);
            //$this->dataCadastro = $this->objfc->dataAtual(2);
            $cst = $this->con->conectar()->prepare("INSERT INTO `estado` (`nome`, `sigla`) VALUES (:nome, :sigla);");
            $cst->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $cst->bindParam(":sigla", $this->sigla, PDO::PARAM_STR);
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
            $cst = $this->con->conectar()->prepare("UPDATE `estado` SET  `nome` = :nome, `sigla` = :sigla WHERE `idEstado` = :idEstado;");
            $cst->bindParam(":idEstado", $this->idEstado, PDO::PARAM_INT);
            $cst->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $cst->bindParam(":sigla", $this->sigla, PDO::PARAM_STR);
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
            $cst = $this->con->conectar()->prepare("DELETE FROM `estado` WHERE `idEstado` = :idEstado;");
            $cst->bindParam(":idEstado", $this->idEstado, PDO::PARAM_INT);
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
