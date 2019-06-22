<?php
header ('Content-type: text/html; charset=UTF-8');
date_default_timezone_set("America/Recife"); 

session_start();

require $_SESSION["installFolder"]."componentes/db/connect.php";

$idPaciente = trim(addslashes(strip_tags($_POST['idPaciente'])));
$idUsuario = $_SESSION['idUsuario'];

$select = $mysqli->query("SELECT p.nomePaciente, dataProntuario, horaProntuario, prontuario, idProntuario FROM prontuarios AS pront 
                                      JOIN pacientes AS p ON p.idPaciente = pront.paciente 
                                      WHERE p.idPaciente = $idPaciente AND pront.medico = $idUsuario ORDER BY dataProntuario ASC, horaProntuario ASC");
$row = $select->num_rows;
if($row){
    while($get = $select->fetch_array()){
        $idProntuario = $get['idProntuario']; 
        $nomePaciente = $get['nomePaciente'];
        $dataProntuario = $get['dataProntuario'];
        $horaProntuario = $get['horaProntuario'];
        $prontuario = $get['prontuario'];

        echo '<div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#'. $idProntuario .'">'. $nomePaciente .' ('. date('d-m-Y', strtotime($dataProntuario)) .' - '. $horaProntuario .') ▾</a>
                    </h4>
                </div>
                <div id="' .$idProntuario. '" class="panel-collapse in">
                    <div class="panel-body">' . nl2br($prontuario) .'</div>
                </div>
            </div>';
    }
}else{
    echo '<center>Nenhum prontuário cadastrado.</center>';
}

exit();
