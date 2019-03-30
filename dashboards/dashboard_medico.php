<center>
  <table id="rcorners1" class="tg table-hover">
    <tr>
      <th class="titulos">PACIENTE</th>
      <th class="titulos">TIPO</th>
      <th class="titulos">DATA - HORA</th>
      <th class="titulos"></th>
    </tr>
    <?php
      $select = $mysqli->query("SELECT p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta, confirmaConsulta, consultaFinalizada, idConsulta, idPaciente FROM consultas AS c 
                                  JOIN pacientes AS p ON p.idPaciente = c.paciente 
                                  JOIN usuarios AS u ON u.idUsuario = c.medico 
                                  WHERE (dataConsulta BETWEEN DATE_ADD(CURDATE(), INTERVAL -1 DAY) AND CURDATE()) AND consultaFinalizada = 0 AND c.medico = $idUsuario ORDER BY dataConsulta ASC, horaConsulta ASC");
      $row = $select->num_rows;
      if($row){
        while($get = $select->fetch_array()){
    ?>
    <tr>

      <!--Nome do Paciente INICIO-->
      <td class="tg-yw4l">
        <a href="<?php echo $_SESSION["installAddress"].'prontuarios/prontuarios.php?idPaciente=' . $get['idPaciente']; ?>">
          <?php echo $get['nomePaciente']; ?>
        </a>
      </td>

      <!--Tipo de Consulta-->
      <td class="tg-yw4l">
        <?php echo $get['tipoConsulta']; ?>
      </td>

      <!--Hora da Consulta-->
      <td class="tg-yw4l">
        <?php
          $data = date('d-m-Y', strtotime($get['dataConsulta']));
          $hora = date('H:i', strtotime($get['horaConsulta']));
          echo $data . ' - ' . $hora;
        ?>
      </td>

      
      <td>
        <!--Confirmação de Consulta-->
        <?php
          if($get['confirmaConsulta'] == '1'){echo '<a href="#" data-toggle="tooltip" data-container="body" title="Consulta Confirmada"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></a>';}
        ?>
        
        &nbsp;
        
        <!--Finalização de Consulta-->
        <?php
          if($get['consultaFinalizada'] == '0'){echo '<a class="anchor" href="'.$_SESSION["installAddress"].'consultas/finalizar.php?consulta='.$get['idConsulta'].'&cod=1" data-toggle="tooltip" data-container="body" title="Clique para Finalizar Consulta"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';}
          else{echo '<a class="anchor" href="'.$_SESSION["installAddress"].'consultas/finalizar.php?consulta='.$get['idConsulta'].'&cod=0" data-toggle="tooltip" data-container="body" title="Clique para Reabrir Consulta"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';}
        ?>
      </td>
      
    </tr>
    <?php
        }
      }else{echo '<b>Não existem consultas agendadas.</b>';}
    ?>
  </table>
</center>