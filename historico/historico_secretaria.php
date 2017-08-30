<?php
session_start();

if($_SESSION["isMedico"] == true){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
 }elseif(empty($_SESSION)){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
}

require("../componentes/db/connect.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Histórico - ConsuCloud</title>

   <?php include "../componentes/boot.php";?>
</head>

<body>

<?php include "../componentes/barra.php"; ?>

  <div class="container">
    <div class="jumbotron">

      <h1>Histórico de Consultas</h1>
			<p>Aqui ficam registradas todas as consultas passadas.</p>

      <br>
      <center>

        <form method="post" action="historico_secretaria.php">
          <?php
            $dataFiltro = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['data'])))));
            $mesFiltro = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['mes'])))));
             if(!empty($mesFiltro)){
               $mesFiltro = date('Y-m',$mesFiltro); 
              }
              if(!empty($dataFiltro)){
                $dataFiltro = date('Y-m-d',$dataFiltro);
              }
          ?>
          <div style="width:350px;">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Dia:</span>
              <input value="<?php echo $dataFiltro ?>" type="date" class="form-control" name="data" aria-describedby="basic-addon1" max="9999-12-31" maxlength="10" OnKeyPress="formatar('##/##/####', this)">
            </div>
            ou
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Mês:</span>
              <input value="<?php echo $mesFiltro ?>" type="month" class="form-control" name="mes" aria-describedby="basic-addon1" max="9999-12" maxlength="7" OnKeyPress="formatar('##/####', this)">
            </div>
          </div>
            
          <p>
	          <button class="btn btn-raised btn-primary" type="submit">Buscar Histórico</button>
          </p>
        </form>

        <table id="rcorners1" class="tg">
          <tr>
            <th class="titulos">PACIENTE</th>
            <th class="titulos">MÉDICO</th>
            <th class="titulos">DATA - HORA</th>
            <th class="titulos">TIPO</th>
            <th class="titulos">PLANO (CARTEIRA)</th>
          </tr>
          <?php
          
          if(!empty($_POST)){
            if(!empty($_POST['mes'])){
              $mesFiltro = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['mes'])))));
              $mesFiltro = date('Y-m-d',$mesFiltro); 
              unset($dataFiltro);
            }elseif (!empty($_POST['data'])){
              $dataFiltro = strtotime(str_replace("/", "-", trim(addslashes(strip_tags($_POST['data'])))));
              $dataFiltro = date('Y-m-d',$dataFiltro);
              unset($mesFiltro);
            }
          }
          
          if($mesFiltro){
              $select = $mysqli->query("SELECT pl.nomePlano, p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta, confirmaConsulta, carteiraPlano FROM consultas AS c 
                                        JOIN pacientes AS p ON p.idPaciente = c.paciente 
                                        JOIN usuarios AS u ON u.idUsuario = c.medico 
                                        JOIN planos AS pl ON c.planoConsulta = pl.idPlano
                                        WHERE dataConsulta BETWEEN '$mesFiltro' AND LAST_DAY('$mesFiltro') ORDER BY dataConsulta ASC, horaConsulta ASC");
          }elseif($dataFiltro){
              $select = $mysqli->query("SELECT pl.nomePlano, p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta, confirmaConsulta, carteiraPlano FROM consultas AS c 
                                        JOIN pacientes AS p ON p.idPaciente = c.paciente 
                                        JOIN usuarios AS u ON u.idUsuario = c.medico 
                                        JOIN planos AS pl ON c.planoConsulta = pl.idPlano
                                        WHERE dataConsulta = '$dataFiltro' ORDER BY dataConsulta ASC, horaConsulta ASC");
          }
              $row = $select->num_rows;
              if($row){
                while($get = $select->fetch_array()){
            ?>
            <tr>
              <!--Nome do Paciente-->
              <td class="tg-yw4l">
                  <?php echo $get['nomePaciente']; ?>
              </td>

              <!--Nome do Medico-->
              <td class="tg-yw4l">
                  <?php echo $get['nomeCompleto']; ?>
              </td>

              <!--Data da Consulta-->
              <td class="tg-yw4l">
                <?php
                  $data = date('d-m-Y', strtotime($get['dataConsulta']));
                  $hora = date('H:i', strtotime($get['horaConsulta']));
                  echo $data . ' - ' . $hora;
                  ?>
              </td>
              
              <!--Tipo de Consulta -->
              <td class="tg-yw4l">
                <?php if($get['tipoConsulta'] == "retorno"){echo "Retorno";}elseif($get['tipoConsulta'] == "primeiraConsulta"){echo "Primeira Consulta";}?>
              </td>

              <!--Plano da Consulta/Carteira do Plano-->
              <td class="tg-yw4l">
                <?php
                  echo $get['nomePlano'];
									if($get['carteiraPlano'] != '0'){echo ' ('.$get['carteiraPlano'].')';}
                  ?>
              </td>

              <!-- Confirmar/Desconfirmar Consultas-->
              <td class="tg-yw4l">
                <?php
                if($get['confirmaConsulta'] == '1'){echo '<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>';}
                else{echo '<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>';}
                ?>
             </td>
             
            </tr>
            <?php
               }
                }else{echo '<b>Sem resultados.</b>';}
             ?>
        </table>
      </center>

    </div>
  </div>

</body>

</html>
