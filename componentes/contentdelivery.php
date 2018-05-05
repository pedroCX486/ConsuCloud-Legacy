<?php
//Loading
echo '<html><body style="background-color: #39b49a"><center><img width="400px" height="300px" src="../assets/carregando.gif"/><br><b>Carregando download...</b></center>';

//Preciso do JQuery
include "boot.php";

if($_GET['backup']){
  //Montar caminho para download do backup
  $filename = $_SESSION["installFolder"].'backup/' . $_GET['arquivo'];
}else{
  //Montar caminho para download de exames
  $filename = $_SESSION["installFolder"].'exames/arquivos/' . $_GET['paciente'] . '/' . $_GET['arquivo'];
}

//Pegar mimetype
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mimeType = finfo_file($finfo, $filename);
finfo_close($finfo);

//Montar base64
$encodedFile = chunk_split(base64_encode(file_get_contents($filename)));

//Montar href para download
echo '<a id="download" href="data:'.$mimeType.';base64,'.$encodedFile.'" download="'.$_GET['arquivo'].'" />';

//Invocar click no href e encerrar a janela automaticamente
?>
<script type="text/JavaScript">
  $(document).ready(function() {
    $('#download').get(0).click();
    setTimeout(function(){
      window.top.close();
    },1000);
  });
</script>