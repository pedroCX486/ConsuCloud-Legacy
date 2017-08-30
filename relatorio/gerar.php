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

  $dataInicio = date('d-m-Y', strtotime($_POST['dataInicio']));
  $dataFim = date('d-m-Y', strtotime($_POST['dataFim']));

?>

<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  
  <?php include "../componentes/boot.php" ?>
  
  <style>
    #pagina {
      height: 297mm;
      width: 210mm;
    }
    @page {
      size: A4;
      margin: 5mm;
    }
  </style>
</head>

<body>

  <center>
    <div id="pagina" style="position:relative;">
      
      <div id="cabecalho" style="text-align: left; position:relative;">
      <h3>
        <b>Relatório Geral</b>
      </h3>
      <h4>
        <?php echo $nomeConsultorio;?>
        <br>
          <?php
            echo $endereco_logradouro . ", " . $endereco_numero . " - " . $endereco_complemento . 
            " - CEP: " . $endereco_cep . "<br>" . $endereco_bairro . " - " . $endereco_cidade . " - " . $endereco_estado . 
            "<br>" . "Telefones: " . $telefone; 
          ?>
      </h4>
        <h5>
          <br><p>Relatório abrange o período de <?php echo $dataInicio . ' até ' . $dataFim; ?>.</p><br>
        </h5>
            
      </div>
            
            <center>
              
            <table id="rcorners1" class="tg">
              <tr>
                <th class="titulos">PACIENTE</th>
                <th class="titulos">MÉDICO</th>
                <th class="titulos">DATA - HORA</th>
                <th class="titulos">PLANO (CARTEIRA)</th>
              </tr>

              <!--Mega Query para dados do relatório-->
              <?php
                $dataInicio = $_POST['dataInicio'];
                $dataFim = $_POST['dataFim'];
                $medico = $_POST['medico'];
                $plano = $_POST['plano'];

                $select = $mysqli->query("SELECT p.nomePaciente, u.nomeCompleto, dataConsulta, horaConsulta, pl.nomePlano, carteiraPlano, confirmaConsulta FROM consultas AS c 
                                        JOIN pacientes AS p ON p.idPaciente = c.paciente 
                                        JOIN planos AS pl ON pl.idPlano = c.planoConsulta
                                        JOIN usuarios AS u ON u.idUsuario = c.medico 
                                        WHERE dataConsulta BETWEEN '$dataInicio' AND '$dataFim' AND c.medico = '$medico' AND c.planoConsulta = '$plano' AND confirmaConsulta = '1' 
                                        ORDER BY dataConsulta DESC, horaConsulta DESC");
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

                    <!--Plano da Consulta-->
                    <td class="tg-yw4l">
                      <?php
                        echo $get['nomePlano'];
                        if($get['carteiraPlano'] != '0'){echo ' ('.$get['carteiraPlano'].')';}
                      ?>
                    </td>
                  </tr>
                  <?php
                  }
                }else{echo '<b>Sem resultados.</b>';}
              ?>
            </table>
            
          <div id="carimbo" style="position: absolute;top:2%; right:5%;">
                    <p>
              Total de Consultas: <?php echo mysqli_num_rows($select) ?>
              <br><br><br>
              ____________________________________________<br>
              Carimbo & Assinatura
            </p>
          </div>

          </div>

          <script type="text/JavaScript">
            setTimeout(function () { window.print(); }, 500);
            setTimeout(window.close, 500);
          </script>

        </body>

        </html>
