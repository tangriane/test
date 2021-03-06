
<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'class/Cliente.php';
require_once 'class/Funcoes.php';

$objFcn = new Cliente();

$objFcs = new Funcoes();

if(isset($_POST['btCadastrar'])){
    if($objFcn->queryInsert($_POST) == 'ok'){
        header('location: /teste');
    }else{
        echo '<script type="text/javascript">alert("Erro em cadastrar");</script>';
    }
}


if(isset($_POST['btAlterar'])){
    if($objFcn->queryUpdate($_POST) == 'ok'){
        header('location: ?acao=edit&func='.$objFcs->base64($_POST['func'],1));
    }else{
        echo '<script type="text/javascript">alert("Erro em alterar");</script>';
    }
}

if(isset($_GET['acao'])){
    switch($_GET['acao']){
        case 'edit': $func = $objFcn->querySeleciona($_GET['func']); break;
        case 'delet':
          if($objFcn->queryDelete($_GET['func']) == 'ok'){
                header('location: /teste');
            }else{
                echo '<script type="text/javascript">alert("Erro em deletar");</script>';
            }
                break;
    }
}

?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Formulário de cadastro</title>
  <link href="css/estilo.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>

<div id="lista">
    <?php foreach($objFcn->querySelect() as $rst){ ?>
    <div class="funcionario">
        <div class="nome"><?=$objFcs->tratarCaracter($rst['nome'], 2)?></div>
        <div class="sigla"><?=$objFcs->tratarCaracter($rst['sigla'], 2)?></div>
        <div class="editar"><a href="?acao=edit&func=<?=$objFcs->base64($rst['idEstado'], 1)?>" title="Editar dados"><img src="img/ico-editar.png" width="16" height="16" alt="Editar"></a></div>
        <div class="excluir"><a href="?acao=delet&func=<?=$objFcs->base64($rst['idEstado'], 1)?>" title="Excluir esse dado"><img src="img/ico-excluir.png" width="16" height="16" alt="Excluir"></a></div>
    </div>
    <?php } ?>
</div>

<div id="formulario">
    <form name="formCad" action="" method="post">

<form name="formCad" action="" method="post">
      <label>Nome: </label><br>
        <input type="text" name="nome" required="required" value="<?=$objFcs->tratarCaracter((isset($func['nome']))?($func['nome']):(''), 2)?>"><br>

          <label>cpf: </label><br>
        <input type="text" name="cpf" required="required" value="<?=$objFcs->tratarCaracter((isset($func['cpf']))?($func['cpf']):(''), 2)?>"><br>
        
          <label>telefone: </label><br>
        <input type="text" name="telefone" required="required" value="<?=$objFcs->tratarCaracter((isset($func['telefone']))?($func['telefone']):(''), 2)?>"><br>

<label>rg: </label><br>
        <input type="text" name="rg" required="required" value="<?=$objFcs->tratarCaracter((isset($func['rg']))?($func['rg']):(''), 2)?>"><br>


      <label>genero: </label><br>
        <input type="text" name="genero" required="required" value="<?=$objFcs->tratarCaracter((isset($func['genero']))?($func['genero']):(''), 2)?>"><br>


        <label>Endereco: </label><br>
        <input type="text" name="estado_id" required="required" /*pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" */ value="<?=$objFcs->tratarCaracter((isset($func['endereco_id']))?($func['endereco_id']):(''), 2)?>"><br>
        <?php if(isset($_GET['acao']) <> 'edit'){ ?>
        <!--<label>Senha: </label><br>
        <input type="password" name="senha" required="required"><br>-->
        <?php } ?>
        <br>





      
        <input type="submit" name="<?=(isset($_GET['acao']) == 'edit')?('btAlterar'):('btCadastrar')?>" value="<?=(isset($_GET['acao']) == 'edit')?('Alterar'):('Cadastrar')?>">
        <input type="hidden" name="func" value="<?=(isset($func['idEstado']))?($func['idEstado']):('')?>">
    </form>
</div>

</body>
</html>
