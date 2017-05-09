<center>
    <table id="rcorners1" class="tg">
        <tr>
            <th class="titulos">PACIENTE</th>
            <th class="titulos">TIPO</th>
            <th class="titulos">DATA - HORA</th>
        </tr>
        <?php
            $select = $mysqli->query("SELECT * FROM consultas WHERE dataConsulta = CURDATE() AND medico = $crm ORDER BY dataConsulta ASC");
            $row = $select->num_rows;
            if($row){
              while($get = $select->fetch_array()){
                //Pegar dados necessários:
                $rgPacienteConsulta = $get['paciente'];
                ?>
            <tr>

                <!--Nome do Paciente INICIO-->
                <td class="tg-yw4l">
                    <?php
                    $rgPaciente = $get['paciente'];
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

                <!--Tipo de Consulta-->
                <td class="tg-yw4l">
                    <?php if($get['tipoConsulta'] == "retorno"){echo "Retorno";} elseif($get['tipoConsulta'] == "primeiraConsulta"){echo "Primeira Consulta";}?>
                </td>

                <!--Hora da Consulta-->
                <td class="tg-yw4l">
                    <?php
                    $data = date('d-m-Y', strtotime($get['dataConsulta']));
                    $hora = date('H:i', strtotime($get['horaConsulta']));
                    echo $data . ' - ' . $hora;
                    ?>
                </td>

                <!--Confirmação de Consulta-->
                <td>
                    <?php
                    if($get['confirmaConsulta'] == '1'){echo '<span class="glyphicon glyphicon-thumbs-up" title="Consulta Confirmada" aria-hidden="true"></span>';}
                    ?>
                </td>
            </tr>
            <?php
              }
            }else{echo '<b>Não existem consultas agendadas.</b>';}
            ?>
    </table>
</center>