<?php
include_once "class/Conexao.php";
include_once "class/Funcoes.php";

class EstadoDao{
  private $con;
  private $objfc;
  private $idcliente;


  public function __construct(){
        $this->con =  new Conexao();
        $this->objfc = new Funcoes();
    }
    2   nome    varchar(45) utf8_general_ci     Sim NULL        Muda Muda   Elimina Elimina 
Mais
    3   cpf varchar(45) utf8_general_ci     Sim NULL        Muda Muda   Elimina Elimina 
Mais
    4   telefone    varchar(45) utf8_general_ci     Sim NULL        Muda Muda   Elimina Elimina 
Mais
    5   rg  varchar(45) utf8_general_ci     Sim NULL        Muda Muda   Elimina Elimina 
Mais
    6   genero

 public function querySeleciona($dado){
        try{
            $this->idcliente = $this->objfc->base64($dado, 2);
            $cst = $this->con->conectar()->prepare("SELECT  idcliente, nome, cpf, telefone, rg, genero, endereco_id FROM `cliente` WHERE `  idcliente` = : idcliente;");
            $cst->bindParam(":  idcliente", $this->    idcliente, PDO::PARAM_INT);
            $cst->execute();
            return $cst->fetch();
        } catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }

    public function querySelect(){
        try{
            $cst = $this->con->conectar()->prepare("SELECT `idcliente`, nome, cpf, telefone, rg, genero, endereco_id  FROM `cliente`;");
            $cst->execute();
            return $cst->fetchAll();
        } catch (PDOException $ex) {
            return 'erro '.$ex->getMessage();
        }
    }

    public function queryInsert($dados){
        try{
            $this->nome = $this->objfc->tratarCaracter($dados['nome'], 1);
            $this->sigla = $dados['cpf'];
            $this->sigla = $dados['telefone'];
            $this->sigla = $dados['rg'];
            $this->sigla = $dados['genero'];
            $this->sigla = $dados['endereco_id'];

            //$this->senha = sha1($dados['sigla']);
            //$this->dataCadastro = $this->objfc->dataAtual(2);
            $cst = $this->con->conectar()->prepare("INSERT INTO `estado` (`nome`,cpf, telefone, rg, genero, endereco_id) VALUES (:nome, :cpf, :telefone, :rg, :genero, :endereco_id);");
            $cst->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $cst->bindParam(":cpf", $this->sigla, PDO::PARAM_STR);
            $cst->bindParam(":telefone", $this->sigla, PDO::PARAM_STR);
            $cst->bindParam(":rg", $this->sigla, PDO::PARAM_STR);
            $cst->bindParam(":genero", $this->sigla, PDO::PARAM_STR);
            $cst->bindParam(":endereco_id", $this->sigla, PDO::PARAM_STR);
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
            $this-> idcliente= $dados['est'];
            $this->nome = $this->objfc->tratarCaracter($dados['nome'], 1);
            $this->sigla = $dados['sigla'];
            $cst = $this->con->conectar()->prepare("UPDATE `estado` SET  `nome` = :nome, `sigla` = :sigla WHERE `   idcliente` = :  idcliente;");
            $cst->bindParam(":  idcliente", $this->    idcliente, PDO::PARAM_INT);
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
            $this-> idcliente = $this->objfc->base64($dado,2);
            $cst = $this->con->conectar()->prepare("DELETE FROM `estado` WHERE `    idcliente` = :   idcliente;");
            $cst->bindParam(":  idcliente", $this->    idcliente, PDO::PARAM_INT);
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
