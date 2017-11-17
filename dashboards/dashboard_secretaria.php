<center>
  <table id="rcorners1" class="tg table-hover">
    <tr>
      <th class="titulos">PACIENTE</th>
      <th class="titulos">TIPO</th>
      <th class="titulos">MÉDICO</th>
      <th class="titulos">DATA - HORA</th>
      <th class="titulos"></th>
    </tr>
    <?php
      $select = $mysqli->query("SELECT p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta, idConsulta, confirmaConsulta FROM consultas AS c 
                              JOIN pacientes AS p ON p.idPaciente = c.paciente 
                              JOIN usuarios AS u ON u.idUsuario = c.medico 
                              WHERE dataConsulta = CURDATE() ORDER BY dataConsulta ASC");
      $row = $select->num_rows;
      if($row){
      while($get = $select->fetch_array()){
    ?>
    <tr>
      <!--Nome do Paciente-->
      <td class="tg-yw4l">
        <?php echo $get['nomePaciente']; ?>
      </td>

      <!--Tipo de Consulta-->
      <td class="tg-yw4l">
        <?php if($get['tipoConsulta'] == "retorno"){echo "Retorno";} elseif($get['tipoConsulta'] == "primeiraConsulta"){echo "Primeira Consulta";}?>
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

      <!--Editar Consultas-->
      <td class="tg-yw4l">
        <a href="consultas/editarconsultas.php?idConsulta=<?php echo $get['idConsulta']; ?>" title="Editar Consulta">
          <span class="glyphicon glyphicon-pencil" aria-hidden="true" />
        </a>

        &nbsp;

        <!-- Confirmar/Desconfirmar Consultas-->
        <?php
          if($get['confirmaConsulta'] == '0'){echo '<a href="../consultas/confirmar.php?confirmar='.$get['idConsulta'].'&cod=1" data-toggle="tooltip" data-container="body" title="Clique para Confirmar Consulta"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>';}
          else{echo '<a href="../consultas/confirmar.php?confirmar='.$get['idConsulta'].'&cod=0" data-toggle="tooltip" data-container="body" title="Clique para Desconfirmar Consulta"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>';}
        ?>
      </td>
    </tr>
    <?php
        }
      }else{echo '<b>Não existem consultas agendadas.</b>';}
    ?>
  </table>
</center>