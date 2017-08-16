<!DOCTYPE html>
<html>
    <head title="ConsuCloud Tools">
        <meta charset="UTF-8">
    </head>

    <body>
        Ferramenta de Criação de Contas de Administrador

        <br><br>

        <form method="post" action="addAdmin.php">
        Email: <input required type="text" name="email" maxlength="100" placeholder="Máximo de 100 caracteres.">
        <br>
        Login: <input required type="text" name="login" maxlength="20" placeholder="Máximo de 20 caracteres.">
        <br>
        Senha: <input required type="text" name="senha" maxlength="20" placeholder="Máximo de 20 caracteres.">
        <button type="submit">Cadastrar</button>
        </form>

        <br><br>

        <?php
        	if($_SERVER['REQUEST_METHOD'] === 'POST') {
        		
            header ('Content-type: text/html; charset=UTF-8');

			$senha = password_hash(trim(addslashes(strip_tags($_POST['senha']))), PASSWORD_DEFAULT);
			$email = trim(addslashes(strip_tags($_POST['email'])));
			$login = trim(addslashes(strip_tags($_POST['login'])));
			
			require "../componentes/db/connect.php";
			
			//Executar queries
			$query = $mysqli->query("INSERT INTO usuarios (crm,tipoUsuario,nomeCompleto,areaAtuacao,RG,RGUFEXP,dataNasc,telCel,telFixo,email,endereco_logradouro,
			endereco_numero,endereco_complemento,endereco_bairro,endereco_cidade,endereco_cep,endereco_estado,login,senha,nomeCurto) 
			VALUES ('SysAdmin', 'admin', 'Administrador', 'Administrador', '0', 'ConsuCloud', '2000-01-01', '00 000000000', '00 00000000', '$email', 'ConsuCloud', '0', 
			'ConsuCloud', 'ConsuCloud', 'ConsuCloud', '0', 'ConsuCloud', '$login', '$senha', 'Admin')");

	            if($query){
	                echo "Cadastrado com sucesso.";
	                $mysqli->close();
	            }else{
	            	echo $mysqli->error;
	            }
            }
            
        ?>

    </body>
</html>