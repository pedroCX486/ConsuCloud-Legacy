<?php
header ('Content-type: text/html; charset=UTF-8');

//Pegar dados enviados via POST
$idPaciente = trim(addslashes(strip_tags($_POST['idPaciente'])));
$dataExame = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['dataExame'])))));
$nomeExame = trim(addslashes(strip_tags($_POST['nomeExame'])));
$descExame = trim(addslashes(strip_tags($_POST['descExame'])));

//Tratar data pra formato americano
$dataExame = date('Y-m-d',$dataExame);

//Criar diretório do paciente para upload de exames
if (!file_exists('arquivos/' . $idPaciente . '/')) {
    mkdir('arquivos/' . $idPaciente . '/', 0777, true);
}

//Arquivos inválidos para upload - Nota: Se for usar esse, é preciso remover a negação (!) do IF e trocar o nome da array
//$invalid_formats = array("exe", "bat", "com", "php", "cgi", "html", "xhtml", "xhtml", "asp", "aspx", "jar", "java", "c", "cs", "py", "dat", "bin", "dll", "so", "sql", "mp3", "wav", "ogg", "mp4", "m4a");

//Arquivos válidos para upload
$valid_formats = array("png", "jpg", "bmp", "gif", "jpeg", "avi", "mp4", "pdf");

    //Se encontrar arquivos enviados, hora do upload
    if(count($_FILES['arquivos']['name']) > 0){
        
        //Fazer loop pela array de arquivos
        for($i=0; $i<count($_FILES['arquivos']['name']); $i++) {

            //Pegar o caminho e nome temporário dos arquivos
            $tmpFilePath = $_FILES['arquivos']['tmp_name'][$i];

            //Testar tamanho dos arquivos
            if($_FILES['arquivos']['size'][$i] > 10485760) { //10 MB (size is also in bytes)
                $erroArquivoGrande = 1;
                $nomeArquivoGrande[] = $_FILES['arquivos']['name'][$i];
                $tmpFilePath = "";

            //Testar tipos de arquivos
            }elseif(!in_array(pathinfo($_FILES['arquivos']['name'][$i], PATHINFO_EXTENSION), $valid_formats)){
                //Ignorar campos em branco pra áreas de multiupload
                if($_FILES['arquivos']['name'][$i] != ""){
                    $erroArquivoInvalido = 1;
                    $nomeArquivoInvalido[] = $_FILES['arquivos']['name'][$i];
                    $tmpFilePath = "";
                }
            }

            //Verificar se o arquivo passou nos testes
            if($tmpFilePath != ""){
            
                //Salvar o nome do arquivo
                $shortname = $_FILES['arquivos']['name'][$i];

                //Salvar a URL e o arquivo
                $filePath = "arquivos/" . $idPaciente . "/" . $_FILES['arquivos']['name'][$i];

								//Verificar se o arquivo já existe
								if(file_exists($filePath)) {
									$filePath = "arquivos/" . $idPaciente . "/" . date('dmY-H.i A') . " " . $_FILES['arquivos']['name'][$i];
                                    $shortname = date('dmY-H.i A') . " " .  $_FILES['arquivos']['name'][$i];
								}

                //Enviar arquivo ao diretório de trabalho
                if(move_uploaded_file($tmpFilePath, $filePath)) {
                    $files[] = $shortname;
                }
              }
        }
    }

    /*
        Papo reto e bem simples:

        $files == 0 se der true, singifica que não tem nenhum arquivo
        $erroArquivoInvalido == 1 se der true, significa que o arquivo é inválido
        $erroArquivoGrande == 1 se der true, significa que o arquivo é muito grande

        Mas, se $files != 0 mesmo com as outras dando true, significa que ainda tem coisa a ser enviada e o upload vai ser finalizado.

        Esse behaviour pode ser alterado no futuro, caso o cliente prefira que o upload seja cancelado TODO caso ocorra erro mesmo que em apenas um arquivo.
    */

    if(count($files) == 0 && $erroArquivoInvalido == 1 && $erroArquivoGrande == 1){ //Verificar se a flag de arquivo grande, arquivo inválido e nenhum arquivo foi ligada
        $msgErroArqInvalido = implode("\\n", array_filter($nomeArquivoInvalido));
        $msgErroArqGrande = implode(" \\n ", array_filter($nomeArquivoGrande));
        echo '<script type="text/javascript">
             alert("Os seguintes arquivos são muito grandes e não foram enviados: \n ' . $msgErroArqGrande . ' \n\nOs seguintes arquivos da lista são inválidos: \n '. $msgErroArqInvalido . ' \n\nO envio foi cancelado.");
             location.href="../exames/exames.php";
             </script>';
        exit();
    }elseif(count($files) != 0 && $erroArquivoInvalido == 1 && $erroArquivoGrande == 1){ //Verificar se a flag de arquivo grande e arquivo inválido foi ligada mas com arquivos válidos
        $msgErroArqInvalido = implode("\\n", array_filter($nomeArquivoInvalido));
        $msgErroArqGrande = implode(" \\n ", array_filter($nomeArquivoGrande));
        echo '<script type="text/javascript">
             alert("Os seguintes arquivos são muito grandes e não foram enviados: \n ' . $msgErroArqGrande . ' \n\nOs seguintes arquivos da lista são inválidos: \n '. $msgErroArqInvalido . '");
             </script>';
        //Resetar flags
        $erroArquivoInvalido = 0;
        $erroArquivoGrande = 0;
    }elseif(count($files) == 0 && $erroArquivoInvalido == 1){ //Verificar se a flag de arquivo inválido e nenhum arquivo foi ligada
        $msgErroArqInvalido = implode("\\n", array_filter($nomeArquivoInvalido));
        echo '<script type="text/javascript">
             alert("Os seguintes arquivos não são válidos e não foram enviados: \n\n'. $msgErroArqInvalido .' \n\nO envio foi cancelado.");
             location.href="../exames/exames.php";
             </script>';
        exit();
    }elseif(count($files) != 0 && $erroArquivoInvalido == 1){ //Verificar se a flag de arquivo inválido foi ligada mas com arquivos válidos
        $msgErroArqInvalido = implode("\\n", array_filter($nomeArquivoInvalido));
        echo '<script type="text/javascript">
             alert("Os seguintes arquivos não são válidos e não foram enviados: \n\n'. $msgErroArqInvalido .'");
             </script>'; 
        //Resetar flags
        $erroArquivoInvalido = 0;   
    }elseif(count($files) == 0 && $erroArquivoGrande == 1){ //Verificar se a flag de arquivo grande e nenhum arquivo foi ligada
        $msgErroArqGrande = implode("\\n", array_filter($nomeArquivoGrande));
        echo '<script type="text/javascript">
             alert("Os seguintes arquivos são muito grandes e não foram enviados: \n\n'. $msgErroArqGrande .' \n\nO envio foi cancelado.");
             location.href="../exames/exames.php";
             </script>';
        exit();
    }elseif(count($files) != 0 && $erroArquivoGrande == 1){ //Verificar se a flag de arquivo grande foi ligada mas com arquivos válidos
        $msgErroArqGrande = implode("\\n", array_filter($nomeArquivoGrande));
        echo '<script type="text/javascript">
             alert("Os seguintes arquivos são muito grandes e não foram enviados: \n\n'. $msgErroArqGrande .'");
             </script>';
        //Resetar flags
        $erroArquivoGrande = 0;
    }elseif(count($files) == 0){ //Verificar se a flag de nenhum arquivo foi ligada
        echo '<script type="text/javascript">
             alert("Houve um erro no upload. Por favor contacte o administrador do sistema ou tente novamente mais tarde.");
             location.href="../exames/exames.php";
             </script>';
        exit();
    }


//Iniciar a session e pegar o CRM do médico logado
session_start();
$idUsuario = $_SESSION["idUsuario"];

//Puxar o connect do banco
require "../componentes/db/connect.php";

//Preparar a lista de arquivos pra ir ao banco
$arqsExame = implode(",", array_filter($files));

//Executar a query
$query = $mysqli->query("INSERT INTO exames (paciente,medico,dataExame,nomeExame,descExame,arqsExame) 
VALUES ('$idPaciente', '$idUsuario', '$dataExame', '$nomeExame', '$descExame', '$arqsExame')"); 

//Se der certo, ir embora daqui e encerrar conexão, senão, estourar um erro.
if ($query){
  
  //Salvar log
  $_SESSION['log'] = "Upload";
  require "../logs/gravarlog.php";

  //Exibir mensagem e finalizar
  $arqsMensagem = implode("\\n", array_filter($files));
  echo '<script type="text/javascript">
            alert("Cadastro realizado com sucesso. Arquivos enviados:\n\n' . $arqsMensagem . '");
            location.href="../exames/exames.php";
        </script>';
}else{
  echo $mysqli->error;
}

$mysqli->close();
?>	