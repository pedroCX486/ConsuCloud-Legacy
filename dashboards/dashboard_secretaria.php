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
      $select = $mysqli->query("SELECT p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta, idConsulta, confirmaConsulta, consultaFinalizada FROM consultas AS c 
                              JOIN pacientes AS p ON p.idPaciente = c.paciente 
                              JOIN usuarios AS u ON u.idUsuario = c.medico 
                              WHERE (dataConsulta BETWEEN DATE_ADD(CURDATE(), INTERVAL -1 DAY) AND CURDATE()) AND consultaFinalizada = 0 ORDER BY dataConsulta ASC");
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
        <?php echo $get['tipoConsulta']; ?>
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
        <a class="anchor" href="consultas/editarconsultas.php?idConsulta=<?php echo $get['idConsulta']; ?>" data-toggle="tooltip" data-container="body" title="Editar Consulta">
          <span class="glyphicon glyphicon-pencil" aria-hidden="true" />
        </a>

        &nbsp;

        <!-- Confirmar/Desconfirmar Consultas-->
        <?php
          if($get['confirmaConsulta'] == '0'){echo '<a class="anchor" href="'.$_SESSION["installAddress"].'consultas/confirmar.php?consulta='.$get['idConsulta'].'&cod=1" data-toggle="tooltip" data-container="body" title="Clique para Confirmar Consulta"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>';}
          else{echo '<a class="anchor" href="'.$_SESSION["installAddress"].'consultas/confirmar.php?consulta='.$get['idConsulta'].'&cod=0" data-toggle="tooltip" data-container="body" title="Clique para Desconfirmar Consulta"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>';}
        ?>
        
        &nbsp;
        
        <!--Finalização de Consulta-->
        <?php
          if($get['consultaFinalizada'] == '1'){echo '<a href="#" data-toggle="tooltip" data-container="body" title="Consulta Finalizada"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>';}
        ?>
      </td>
    </tr>
    <?php
        }
      }else{echo '<b>Não existem consultas agendadas.</b>';}
    ?>
  </table>
</center>