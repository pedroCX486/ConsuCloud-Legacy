<?php
session_start();

if($_SESSION["isMedico"] == true || !$_SESSION){
  header("Location: ../index.php?erro=ERROFATAL");
  exit();
}elseif(empty($_SESSION)){
  header("Location: ../logout.php");
  exit();
}

require("../assets/connect.php");

$select0 = $mysqli->query("SELECT * FROM configs");
$row0 = $select0->num_rows;
if($row0){
  while($get0 = $select0->fetch_array()){
    $nomeConsultorio = $get0['nomeConsultorio'];
    $telefone = $get0['telefone'];
    $email = $get0['email'];
    $endereco_logradouro = $get0['endereco_logradouro'];
    $endereco_numero = $get0['endereco_numero'];
    $endereco_complemento = $get0['endereco_complemento'];
    $endereco_bairro = $get0['endereco_bairro'];
    $endereco_cidade = $get0['endereco_cidade'];
    $endereco_cep = $get0['endereco_cep'];
    $endereco_estado = $get0['endereco_estado'];
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <?php include "../assets/bootstrap.php" ?>
  
  <style>
    #pagina {
      border-style: solid;
      border-width: 1px;
      height: 297mm;
      width: 210mm;
      align: center;
    }
    @page {
      size: A4;
      margin: 5mm;
    }
  </style>
</head>

<body>

  <center>
    <div id="pagina">
      <center>
        <h1> Relatório Geral - <?php echo $nomeConsultorio;?>
          <h3><?php echo $endereco_logradouro . ", " . $endereco_numero . " - " . $endereco_complemento . " - CEP: " . $endereco_cep . "<br>" . $endereco_bairro . " - " . $endereco_cidade . " - " . $endereco_estado . "<br>" . "Telefones: " . $telefone; ?></h2>

            <?php
              $dataInicio = date('d-m-Y', strtotime($_GET['dataInicio']));
              $dataFim = date('d-m-Y', strtotime($_GET['dataFim']));
            ?>

            <h5>
              <br><p>Relatório abrange o período de <?php echo $dataInicio . ' até ' . $dataFim; ?>.</p><br>
            </h5>
            <table id="rcorners1" class="tg">
              <tr>
                <th class="titulos">PACIENTE</th>
                <th class="titulos">MÉDICO</th>
                <th class="titulos">DATA - HORA</th>
                <th class="titulos">PLANO (CARTEIRA)</th>
              </tr>

              <!--Mega Query para buscar os dados do relatório-->
              <?php
                $dataInicio = $_GET['dataInicio'];
                $dataFim = $_GET['dataFim'];
                $medico = $_GET['medico'];
                $plano = $_GET['plano'];

                $select = $mysqli->query("SELECT * FROM consultas WHERE dataConsulta BETWEEN '$dataInicio' AND '$dataFim' AND medico = '$medico' and planoConsulta = '$plano' and confirmaConsulta = '1' ORDER BY dataConsulta DESC");
                $row = $select->num_rows;
                if($row){
                  while($get = $select->fetch_array()){
                    //Pegar dados necessários:
                    $rgPacienteConsulta = $get['paciente'];
                    $CRMconsulta = $get['medico'];
                    $planoConsulta = $get['planoConsulta'];
              ?>
                  <tr>

                    <!--Nome do Paciente-->
                    <td class="tg-yw4l">
                      <?php
                        $select1 = $mysqli->query("SELECT * FROM pacientes where numIdRG = $rgPacienteConsulta");
                        $row1 = $select1->num_rows;
                        if($row1){
                          while($get1 = $select1->fetch_array()){
                            $nomePaciente = $get1['nomeComp'];
                            $idPaciente = $get1['numIdRG'];
                          }
                        }
                        if($rgPacienteConsulta == $idPaciente){echo $nomePaciente;}
                      ?>
                    </td>

                    <!--Nome do Medico-->
                    <td class="tg-yw4l">
                      <?php
                        $select2 = $mysqli->query("SELECT * FROM usuarios where crm = $CRMconsulta");
                        $row2 = $select2->num_rows;
                        if($row2){
                          while($get2 = $select2->fetch_array()){
                            $nomeMedico = $get2['nomeComp'];
                            $crmMedico = $get2['crm'];
                          }
                        }
                        if($CRMconsulta == $crmMedico){echo $nomeMedico;}
                      ?>
                    </td>

                    <!--Data da Consulta-->
                    <td class="tg-yw4l">
                      <?php
                        $data = date('d-m-Y', strtotime($get['dataConsulta']));
                        $hora = date('H:i', strtotime($get['horaConsulta']));
                        echo $data . ' - ' . $hora;
                      ?>
                    </td>

                    <!--Plano da Consulta-->
                    <td>
                      <?php
                        $select3 = $mysqli->query("SELECT * FROM planos where id = $planoConsulta");
                        $row3 = $select3->num_rows;
                        if($row3){
                          while($get3 = $select3->fetch_array()){
                            $nomePlano = $get3['nomePlano'];
                            $idPlano = $get3['id'];
                          }
                        }
                        if($planoConsulta == $idPlano && $idPlano == '1'){echo $nomePlano;}
                        elseif($planoConsulta == $idPlano && $idPlano != '1'){echo $nomePlano . ' (' . $get['carteiraPlano'] . ')';}
                      ?>
                    </td>
                  </tr>
                  <?php
                }
              }else{echo '<b>Sem resultados.</b>';}
              ?>
            </table>

            <br><br>
            <p>
              Total de Consultas: <?php echo mysqli_num_rows($select) ?>
              <br><br><br>
              ____________________________________________<br>
              Carimbo & Assinatura
            </p>
          </div>

          <script type="text/JavaScript">
            setTimeout(function () { window.print(); }, 500);
            setTimeout(window.close, 500);
          </script>

        </body>

        </html>
