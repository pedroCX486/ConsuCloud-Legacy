<!DOCTYPE html>
<html>
    <head title="ConsuCloud Tools">
        <meta charset="UTF-8">
        <meta http-equiv="Cache-control" content="no-cache">
        <meta http-equiv="Expires" content="-1">
    </head>

    <body>
        Ferramenta de Ativação/Desativação de Contas do Sistema

        <br><br>

        <form method="POST" action="flagAccount.php">
        <input required style="width: 350px;" type="text" name="login" maxlength="20" placeholder="Escolha um login da lista abaixo e digite aqui.">
        <button type="submit">DESATIVAR/ATIVAR</button>
        </form>

        <br><br>

        <?php
				header ('Content-type: text/html; charset=UTF-8');
				require("../componentes/db/connect.php");
				
				$select = $mysqli->query("SELECT * FROM usuarios");
				$row = $select->num_rows;
				if($row){
				  while($get = $select->fetch_array()){
				  	$loginDB[] = $get['login'];
				    $contaStatus[] = $get['contaAtiva'];
				  }
				}
				
				echo "Lista de Usuários: <br><li>";
				echo join('<br><li>', array_map(
				    function ($printUsername, $printStatus) { return "$printUsername (Status: $printStatus)"; },
				    $loginDB,
				    $contaStatus
				));
				
				echo "<br><br>Status 1: Conta Ativa <br> Status 0: Conta Inativa";
				
			if($_SERVER['REQUEST_METHOD'] === 'POST'){
				$login = trim(addslashes(strip_tags($_POST['login'])));
				
				$select = $mysqli->query("SELECT * FROM usuarios WHERE login = '$login'");
				$row = $select->num_rows;
				if($row){
				  while($get = $select->fetch_array()){
				  	$nomedeusuario = $get['login'];
				    $contaAtiva = $get['contaAtiva'];
				  }
				}
				
				if($contaAtiva == '1'){
					$query = $mysqli->query("UPDATE usuarios SET contaAtiva = '0' WHERE login = '$login'");
				}elseif($contaAtiva == '0'){
					$query = $mysqli->query("UPDATE usuarios SET contaAtiva = '1' WHERE login = '$login'");
				}
				
				if($query){
                    $mysqli->close();
                	header('Location: flagAccount.php');
				}else{
                    echo $mysqli->error;
                }
            }
        ?>
    </body>
</html>