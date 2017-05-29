<center>
    <table id="rcorners1" class="tg">
        <tr>
            <th class="titulos">PACIENTE</th>
            <th class="titulos">TIPO</th>
            <th class="titulos">DATA - HORA</th>
        </tr>
        <?php
            $select = $mysqli->query("SELECT p.nomePaciente, u.nomeCompleto, tipoConsulta, dataConsulta, horaConsulta, confirmaConsulta FROM consultas AS c 
                                        JOIN pacientes AS p ON p.idPaciente = c.paciente 
                                        JOIN usuarios AS u ON u.idUsuario = c.medico 
                                        WHERE dataConsulta = CURDATE() AND c.medico = $idUsuario ORDER BY dataConsulta ASC, horaConsulta ASC");
            $row = $select->num_rows;
            if($row){
              while($get = $select->fetch_array()){
                ?>
            <tr>

                <!--Nome do Paciente INICIO-->
                <td class="tg-yw4l">
                  <?php echo $get['nomePaciente']; ?>
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