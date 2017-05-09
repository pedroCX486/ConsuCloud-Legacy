<center>
    <table id="rcorners1" class="tg">
        <tr>
            <th class="titulos">PACIENTE</th>
            <th class="titulos">TIPO</th>
            <th class="titulos">MÉDICO</th>
            <th class="titulos">DATA - HORA</th>
        </tr>
            <?php
                $select = $mysqli->query("SELECT * FROM consultas WHERE dataConsulta = CURDATE() ORDER BY dataConsulta ASC");
                $row = $select->num_rows;
                if($row){
                while($get = $select->fetch_array()){
                    //Pegar dados necessários:
                    $rgPacienteConsulta = $get['paciente'];
                    $CRMconsulta = $get['medico'];
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

                <!--Tipo de Consulta-->
                <td class="tg-yw4l">
                    <?php if($get['tipoConsulta'] == "retorno"){echo "Retorno";} elseif($get['tipoConsulta'] == "primeiraConsulta"){echo "Primeira Consulta";}?>
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

                <!--Editar Consultas-->
                <td class="tg-yw4l">
                    <a href="consultas/editarconsultas.php?editar=<?php echo $get['idConsulta']; ?>" title="Editar Consulta"><span class="glyphicon glyphicon-pencil" aria-hidden="true" /></a>
                    &nbsp;

                    <!-- Confirmar/Desconfirmar Consultas-->
                    <?php
                        if($get['confirmaConsulta'] == '0'){echo '<a href="consultas/confirmar.php?confirmar='.$get['idConsulta'].'&cod=1" title="Confirmar Consulta"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>';}
                        else{echo '<a href="consultas/confirmar.php?confirmar='.$get['idConsulta'].'&cod=0" title="Desconfirmar Consulta"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>';}
                    ?>
                </td>
            </tr>
            <?php
              }
            }else{echo '<b>Não existem consultas agendadas.</b>';}
            ?>
    </table>
</center>