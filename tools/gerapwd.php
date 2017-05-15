<html>
    <head title="ConsuCloud Tools">
        <meta charset="UTF-8">
    </head>

    <body>
        Ferramenta de resgate de contas SysAdmin

        <br><br>

        <form method="post" action="gerapwd.php">
        <input required type="text" name="senha" maxlength="20" placeholder="Máximo de 20 caracteres.">
        <button type="submit">GERAR</button>
        </form>

        <br><br>

        <?php
            $senha = trim(addslashes(strip_tags($_POST['senha'])));

            if($senha != ""){
                $senha = password_hash(trim(addslashes(strip_tags($_POST['senha']))), PASSWORD_DEFAULT);
                echo "HASH GERADO: <br>" . $senha . "<br><br><br><br>";

                require("../assets/connect.php");
                $query = $mysqli->query("UPDATE usuarios SET senha = '$senha' WHERE crm = 'SysAdmin'");

                if($query){
                        echo "Senha alterada com sucesso.";
                }else{
                        echo $mysqli->error;
                     }
            }
            $mysqli->close();
        ?>

    </body>
</html>