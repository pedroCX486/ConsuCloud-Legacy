<?php
header ('Content-type: text/html; charset=UTF-8');

$idPlano = trim(addslashes(strip_tags($_POST['idPlano'])));
$nomePlano = trim(addslashes(strip_tags($_POST['nomePlano'])));
$telFixo = trim(addslashes(strip_tags($_POST['telFixo'])));
$email = trim(addslashes(strip_tags($_POST['email'])));
$infoPlano = trim(addslashes(strip_tags($_POST['infoPlano'])));
$endereco_logradouro = trim(addslashes(strip_tags($_POST['endereco_logradouro'])));
$endereco_numero = trim(addslashes(strip_tags($_POST['endereco_numero'])));
$endereco_complemento = trim(addslashes(strip_tags($_POST['endereco_complemento'])));
$endereco_bairro = trim(addslashes(strip_tags($_POST['endereco_bairro'])));
$endereco_cidade = trim(addslashes(strip_tags($_POST['endereco_cidade'])));
$endereco_cep = trim(addslashes(strip_tags($_POST['endereco_cep'])));
$endereco_estado = trim(addslashes(strip_tags($_POST['endereco_estado'])));

//Chegacem de caracteres invalidos em alguns campos (caso usuário burle no front-end)
if(!ctype_digit($endereco_cep)) {
    echo '<script type="text/javascript">
            alert("ERRO: Caracteres inválidos no campo CEP.\nApenas caracteres numéricos são permitidos.");
            location.href="'.$_SESSION["installAddress"].'usuarios/cadastrarusuarios.php";
          </script>';
	exit();
}

require $_SERVER['DOCUMENT_ROOT']."componentes/db/connect.php";

// Perform queries 
$query = $mysqli->query("UPDATE planos SET nomePlano = '$nomePlano', telFixo = '$telFixo', email = '$email', infoPlano = '$infoPlano', 
endereco_logradouro = '$endereco_logradouro', endereco_numero = '$endereco_numero', endereco_complemento = '$endereco_complemento', endereco_bairro = '$endereco_bairro', 
endereco_cidade = '$endereco_cidade', endereco_cep = '$endereco_cep', endereco_estado = '$endereco_estado' WHERE idPlano = '$idPlano'");


if ($query){
  echo '<script type="text/javascript">
					alert("Atualização realizada com sucesso.");
					location.href="'.$_SESSION["installAddress"].'planos/planos.php";
        </script>';
}else{
  echo $mysqli->error;
}

$mysqli->close();

isset($_SESSION['PlanoEdit']);
?>