<?php
  session_start();
  require $_SERVER['DOCUMENT_ROOT']."/componentes/db/connect.php";
?>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<?php include "../componentes/boot.php";?>
		<style>
			@page { size: A4 portrait; margin: 3mm; }
			html, body { height: 100%; width: 100%; margin: 0; }
		</style>
	</head>
	
	<body>
		<center>
			
			<h1>Registro de Logs<br><small>ConsuCloud</small></h1>
		
		<br><br>
		
          <table id="rcorners1" class="tg">
            <tr>
              <b>
	            <th class="titulos">LOG</th>
	            <th class="titulos">USUÁRIO</th>
	            <th class="titulos">IP</th>
	            <th class="titulos">DIA</th>
	            <th class="titulos">HORA</th>
             </b>
            </tr>
            
	<?php
	if(!empty($_GET)){
               
               $usuario = $_GET['usuario'];
               $dataInicio = $_GET['dataInicio'];
               $dataFim = $_GET['dataFim'];
                
              if($usuario == "" && $dataInicio == "" && $dataFim == ""){
                 $select = $mysqli->query("SELECT * FROM logs WHERE dataLog >= ( CURDATE() - INTERVAL 15 DAY )");
              }elseif($usuario != "" && $dataInicio != "--" && $dataFim != "--"){
                $select = $mysqli->query("SELECT * FROM logs WHERE dataLog BETWEEN '$dataInicio' AND '$dataFim' AND usuario = '$usuario'");
              }elseif($dataInicio != "--" && $dataFim != "--"){
                $select = $mysqli->query("SELECT * FROM logs WHERE dataLog BETWEEN '$dataInicio' AND '$dataFim'");
              }elseif($usuario != "" && $dataInicio != "--"){
                $select = $mysqli->query("SELECT * FROM logs WHERE dataLog >= '$dataInicio' AND usuario = '$usuario'");
              }elseif($dataInicio != "--" && $dataFim == "--"){
                $select = $mysqli->query("SELECT * FROM logs WHERE dataLog >= '$dataInicio'");
              }elseif($usuario != ""){
                $select = $mysqli->query("SELECT * FROM logs WHERE usuario = '$usuario'");
              }
            }else{
             $select = $mysqli->query("SELECT * FROM logs WHERE dataLog >= ( CURDATE() - INTERVAL 15 DAY )");
            }
             $row = $select->num_rows;
              if($row){
                while($get = $select->fetch_array()){
            ?>
              <tr>
                <td style="border-right: solid 1px #000; border-left: solid 1px #000;" class="tg-yw4l">
                  <?php echo $get['log']; ?>
                </td>
                <td style="border-right: solid 1px #000; border-left: solid 1px #000;" class="tg-yw4l">
                  <?php echo $get['usuario']; ?>
                </td>
                <td style="border-right: solid 1px #000; border-left: solid 1px #000;" class="tg-yw4l">
                  <?php echo $get['ip']; ?>
                </td>
                <td style="border-right: solid 1px #000; border-left: solid 1px #000;" class="tg-yw4l">
                  <?php echo $data = date('d/m/Y', strtotime($get['dataLog'])); ?>
                </td>
                <td style="border-right: solid 1px #000; border-left: solid 1px #000;" class="tg-yw4l">
                  <?php echo $get['horaLog']; ?>
                </td>
              </tr>
              <?php
               }
                }else{echo '<b>Não existem registros de logs.</b>';}
             ?>
          </table>
        </center>
		
  <!--JS para Invocar Impressão-->
  <script type="text/JavaScript">
    $(window).bind("load", function() {
      window.print();
      window.top.close();
    });
  </script>
	  
	</body>
</html>