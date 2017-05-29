<?php
header ('Content-type: text/html; charset=UTF-8');

$nomeConsultorio = trim(addslashes(strip_tags($_POST['nomeConsultorio'])));
$telefone = trim(addslashes(strip_tags($_POST['telefone'])));
$email = trim(addslashes(strip_tags($_POST['email'])));
$endereco_logradouro = trim(addslashes(strip_tags($_POST['endereco_logradouro'])));
$endereco_numero = trim(addslashes(strip_tags($_POST['endereco_numero'])));
$endereco_complemento = trim(addslashes(strip_tags($_POST['endereco_complemento'])));
$endereco_bairro = trim(addslashes(strip_tags($_POST['endereco_bairro'])));
$endereco_cidade = trim(addslashes(strip_tags($_POST['endereco_cidade'])));
$endereco_cep = trim(addslashes(strip_tags($_POST['endereco_cep'])));
$endereco_estado = trim(addslashes(strip_tags($_POST['endereco_estado'])));

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
                $filePath = $_FILES['arquivos']['name'][$i];

                //Enviar arquivo ao diretório de trabalho
                if(move_uploaded_file($tmpFilePath, $filePath)) {
                    $files = $shortname;
                }
              }
        }
    }

    if(count($files) == 0 && $erroArquivoInvalido == 1){ //Verificar se a flag de arquivo inválido e nenhum arquivo foi ligada
        $msgErroArqInvalido = implode("\\n", array_filter($nomeArquivoInvalido));
        echo '<script type="text/javascript">
             alert("Os seguinte arquivos não são válidos e não foram enviados: \n\n'. $msgErroArqInvalido .' \n\nAs configurações não foram salvas");
             location.href="../exames/exames.php";
             </script>';
        exit();
    }elseif(count($files) == 0 && $erroArquivoGrande == 1){ //Verificar se a flag de arquivo grande e nenhum arquivo foi ligada
        $msgErroArqGrande = implode("\\n", array_filter($nomeArquivoGrande));
        echo '<script type="text/javascript">
             alert("Os seguintes arquivos são muito grandes e não foram enviados: \n\n'. $msgErroArqGrande .' \n\nAs configurações não foram salvas.");
             location.href="../exames/exames.php";
             </script>';
        exit();
    }    

//Conexão com db
require "../assets/connect.php";

if($files){
    $select = $mysqli->query("SELECT * FROM configs");
    $row = $select->num_rows;
    if($row){              
      while($get = $select->fetch_array()){
        $logotipo = $get['logotipo'];
      }
    }
    
    unlink($logotipo);
    
    //Executar query
    $query = $mysqli->query("UPDATE configs SET nomeConsultorio = '$nomeConsultorio', telefone = '$telefone', email = '$email', logotipo = '$files', endereco_logradouro = '$endereco_logradouro', endereco_numero = '$endereco_numero', endereco_complemento = '$endereco_complemento', endereco_bairro = '$endereco_bairro', 
    endereco_cidade = '$endereco_cidade', endereco_cep = '$endereco_cep', endereco_estado = '$endereco_estado'");
}else{
    //Executar query
    $query = $mysqli->query("UPDATE configs SET nomeConsultorio = '$nomeConsultorio', telefone = '$telefone', email = '$email', endereco_logradouro = '$endereco_logradouro', endereco_numero = '$endereco_numero', endereco_complemento = '$endereco_complemento', endereco_bairro = '$endereco_bairro', 
    endereco_cidade = '$endereco_cidade', endereco_cep = '$endereco_cep', endereco_estado = '$endereco_estado'");
}

if ($query){
  echo '<script type="text/javascript">
					alert("Configurações atualizadas com sucesso.");
					location.href="../config/config.php";
					</script>';
}else{
  echo $mysqli->error;
}

$mysqli->close();
?>