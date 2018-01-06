<?php
<<<<<<< HEAD

//Connect do DB
include_once("../componentes/db/connect.php");

//Iniciando session
session_start();

//Checagem de usuário da session
if($_SESSION["isSecretaria"] == true || $_SESSION["isAdmin"] == true){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
 }elseif(empty($_SESSION)){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
}

=======
session_start();

require("../componentes/sessionbuster.php");

if(!$_SESSION["isMedico"]){
  echo "<script>top.window.location = '../index.php?erro=ERROFATAL'</script>";
  die;
 }elseif(empty($_SESSION)){
  echo "<script>top.window.location = '../index.php?erro=ERROFATAL'</script>";
  die;
}

require("../componentes/db/connect.php");
>>>>>>> consucloud-2/master
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Exames - ConsuCloud</title>

<<<<<<< HEAD
   <?php include "../componentes/boot.php";?>
</head>

<body>

<?php include "../componentes/barra.php"; ?>

<script>
  function formatar(mascara, documento) {
    var i = documento.value.length;
    var saida = mascara.substring(0, 1);
    var texto = mascara.substring(i)

    if (texto.substring(0, 1) != saida) {
      documento.value += texto.substring(0, 1);
    }

  }
</script>

<div class="container">
  <div class="jumbotron">
    <h1><small>Cadastrar Exame</small></h1><br>
    
        <div class="buscar">
          <form method="post" action="cadastrarexames.php">
  
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Nome do Paciente:</span>
            <input type="text" class="form-control" name="nomePaciente" aria-describedby="basic-addon1" maxlength="150" placeholder="Campo opcional. Preencha um ou ambos campos." value="<?php echo $_POST['nomePaciente']; ?>">
          </div>
          
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">RG do Paciente:</span>
            <input type="number" class="form-control" name="rgPaciente" aria-describedby="basic-addon1" maxlength="150" placeholder="Campo opcional. Preencha um ou ambos campos." value="<?php echo $_POST['rgPaciente']; ?>">
          </div>
  
            <br>
  
            <center><button type="submit" class="btn btn-raised btn-info">Buscar Paciente</button> &nbsp; <a href="cadastrarexames.php"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></center>
          </form>
        </div>

    <div class="cadastro">
      <form method="post" action="cadastrar.php" enctype="multipart/form-data">

        <div class="form-group">
          <select required name="idPaciente" class="form-control">
              <option disabled selected value="">Nome do Paciente*</option>
                <?php        
                if(!empty($_POST)){
                  
                    $idUsuario = $_SESSION['idUsuario'];
              
                    if($_POST['nomePaciente'] != ""){
                      $busca = $_POST['nomePaciente'];
                      
                      $select = $mysqli->query("SELECT * FROM pacientes WHERE nomePaciente = '$busca'");
                      
                    }elseif($_POST['rgPaciente'] != ""){
                      $busca = $_POST['rgPaciente'];
                      
                      $select = $mysqli->query("SELECT * FROM pacientes WHERE RG = '$busca'");
                      
                    }else{
                      $busca1 = $_POST['rgPaciente'];
                      $busca2 = $_POST['nomePaciente'];
                      
                      $select = $mysqli->query("SELECT * FROM pacientes WHERE nomePaciente = '$busca1' AND RG = '$busca2'");
                      
                    }
                
                  }
                  $row = $select->num_rows;
                  if($row){              
                    while($get = $select->fetch_array()){
                      ?>
                        <option value="<?php echo $get['idPaciente']; ?>" ><?php echo $get['RG'] . ' - ' . $get['nomePaciente']; ?></option>
                      <?php
                    }
                  }
                ?>
              </select>
        </div>

        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">Data do Exame:*</span>
          <input required type="date" class="form-control" name="dataExame" aria-describedby="basic-addon1" maxlength="10" max="9999-12-31"
            OnKeyPress="formatar('##/##/####', this)">
        </div>

        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">Nome do Exame:*</span>
          <input required type="text" class="form-control" name="nomeExame" aria-describedby="basic-addon1" maxlength="250">
        </div>

        <br>

        <div class="form-group">
          <label id="prontuario">Descrição do Exame</label>
          <textarea required name="descExame" class="form-control" rows="5"></textarea>
        </div>

        <script src="../componentes/fileSelect.js"></script>

        <br>Tamanho máximo: 10MB/Arquivo (50MB somando todos os arquivos.)
        <br>Tipos de arquivos aceitos: .jpg, .png, .jpeg, .gif, .bmp, .avi, .mp4, .pdf
        <br><br>

        <div class="input-group">
          <label class="input-group-btn">
                    <span class="btn btn-raised btn-primary">
                        ANEXAR <input type="file" id="arquivo" name="arquivos[]" accept=".jpg, .png, .jpeg, .gif, .bmp, .avi, .mp4, .pdf" style="display: none;">
                    </span>
                </label>
          <input type="text" class="form-control" readonly>
        </div>

        <div class="input-group">
          <label class="input-group-btn">
                    <span class="btn btn-raised btn-primary">
                        ANEXAR <input type="file" id="arquivo" name="arquivos[]" accept=".jpg, .png, .jpeg, .gif, .bmp, .avi, .mp4, .pdf" style="display: none;">
                    </span>
                </label>
          <input type="text" class="form-control" readonly>
        </div>

        <div class="input-group">
          <label class="input-group-btn">
                    <span class="btn btn-raised btn-primary">
                        ANEXAR <input type="file" id="arquivo" name="arquivos[]" accept=".jpg, .png, .jpeg, .gif, .bmp, .avi, .mp4, .pdf" style="display: none;">
                    </span>
                </label>
          <input type="text" class="form-control" readonly>
        </div>

        <div class="input-group">
          <label class="input-group-btn">
                    <span class="btn btn-raised btn-primary">
                        ANEXAR <input type="file" id="arquivo" name="arquivos[]" accept=".jpg, .png, .jpeg, .gif, .bmp, .avi, .mp4, .pdf" style="display: none;">
                    </span>
                </label>
          <input type="text" class="form-control" readonly>
        </div>

        <div class="input-group">
          <label class="input-group-btn">
                    <span class="btn btn-raised btn-primary">
                        ANEXAR <input type="file" id="arquivo" name="arquivos[]" accept=".jpg, .png, .jpeg, .gif, .bmp, .avi, .mp4, .pdf" style="display: none;">
                    </span>
                </label>
          <input type="text" class="form-control" readonly>
        </div>

        <br>

        <center><button type="submit" name="submit" class="btn btn-raised btn-primary btn-lg">SALVAR EXAME</button></center>

      </form>

    </div>
  </div>
</div>
=======
  <?php include "../componentes/boot.php";?>
  <script src="../componentes/maskFormat.js"></script>
  <script src="../componentes/tabBusca.js"></script>
</head>

<body>
  
  <?php include "../componentes/barra.php"; ?>
  
  <div class="container">
    <div class="jumbotron">
      <h1>
        <small>Cadastrar Exame</small>
         <a class="anchor" href="exames.php">
          <button class="btn btn-raised btn-danger pull-right" onClick="return confirm('Tem certeza que deseja sair?')">CANCELAR CADASTRO</button>
        </a>
      </h1>
      <br>

      <div class="buscar">
        <form method="post" action="cadastrarexames.php">

          <center>
            <b>Tipo de Busca:</b>
            <br>
            <input type="radio" name="tabBusca" onclick="showNome();" value="nome" <?php if($_POST['tabBusca'] == 'nome' || empty($_POST['tabBusca'])){echo 'checked';}?>/> Por Nome &nbsp;
            <input type="radio" name="tabBusca" onclick="showRG();" value="rg" <?php if($_POST['tabBusca'] == 'rg'){echo 'checked';}?>/> Por RG
          </center>

          <div class="input-group" id="divNOME" <?php if($_POST['tabBusca'] == 'nome' || empty($_POST['tabBusca'])){echo 'style="display: inline-table;"';}else{echo 'style="display: none;"';}?>>
            <span class="input-group-addon" id="basic-addon1">Nome do Paciente:</span>
            <input type="text" class="form-control" name="nomePaciente" id="nomePaciente" aria-describedby="basic-addon1" maxlength="150" value="<?php echo $_POST['nomePaciente']; ?>" pattern="([A-zÀ-ž\s]){2,}" title="Sr João da Silva Filho (Apenas Letras)">
          </div>

          <div class="input-group" id="divRG" <?php if($_POST['tabBusca'] == 'rg'){echo 'style="display: inline-table;"';}else{echo 'style="display: none;"';}?>>
            <span class="input-group-addon" id="basic-addon1">RG do Paciente:</span>
            <input type="number" class="form-control" name="rgPaciente" id="rgPaciente" aria-describedby="basic-addon1" maxlength="150" value="<?php echo $_POST['rgPaciente']; ?>">
          </div>

          <br>

          <center>
            <button type="submit" class="btn btn-raised btn-info">Buscar Paciente</button> &nbsp;
            <a class="anchor" href="cadastrarexames.php">
              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </a>
          </center>
        </form>
      </div>

      <div class="cadastro">
        <form method="post" action="cadastrar.php" enctype="multipart/form-data">

          <div class="form-group">
            <select required name="idPaciente" class="form-control">
              <option disabled selected value="">Nome do Paciente*</option>
              <?php
                if(!empty($_POST)){

                    $idUsuario = $_SESSION['idUsuario'];

                    if($_POST['nomePaciente'] != ""){
                      $busca = $_POST['nomePaciente'];

                      $select = $mysqli->query("SELECT * FROM pacientes WHERE nomePaciente LIKE '%$busca%'");

                    }elseif($_POST['rgPaciente'] != ""){
                      $busca = $_POST['rgPaciente'];

                      $select = $mysqli->query("SELECT * FROM pacientes WHERE RG = '$busca'");

                    }
                  }

                  $row = $select->num_rows;
                  if($row){              
                    while($get = $select->fetch_array()){
              ?>
              <option value="<?php echo $get['idPaciente']; ?>">
                <?php echo $get['RG'] . ' - ' . $get['nomePaciente']; ?>
              </option>
              <?php
                  }
                }
              ?>
            </select>
          </div>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Data do Exame:*</span>
            <input required type="date" class="form-control" name="dataExame" aria-describedby="basic-addon1" maxlength="10" max="9999-12-31"
              OnKeyPress="formatar('##/##/####', this)">
          </div>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Nome do Exame:*</span>
            <input required type="text" class="form-control" name="nomeExame" aria-describedby="basic-addon1" maxlength="250">
          </div>

          <br>

          <div class="form-group">
            <label id="prontuario">Descrição do Exame</label>
            <textarea required name="descExame" class="form-control" rows="5"></textarea>
          </div>

          <script src="../componentes/fileSelect.js"></script>

          <br>Tamanho máximo: 10MB/Arquivo (50MB somando todos os arquivos.)
          <br>Tipos de arquivos aceitos: .jpg, .png, .jpeg, .gif, .bmp, .avi, .mp4, .pdf
          <br>
          <br>

          <div class="input-group">
            <label class="input-group-btn">
              <span class="btn btn-raised btn-primary">
                ANEXAR
                <input type="file" id="arquivo" name="arquivos[]" accept=".jpg, .png, .jpeg, .gif, .bmp, .avi, .mp4, .pdf"
                  style="display: none;">
              </span>
            </label>
            <input type="text" class="form-control" readonly>
          </div>

          <div class="input-group">
            <label class="input-group-btn">
              <span class="btn btn-raised btn-primary">
                ANEXAR
                <input type="file" id="arquivo" name="arquivos[]" accept=".jpg, .png, .jpeg, .gif, .bmp, .avi, .mp4, .pdf"
                  style="display: none;">
              </span>
            </label>
            <input type="text" class="form-control" readonly>
          </div>

          <div class="input-group">
            <label class="input-group-btn">
              <span class="btn btn-raised btn-primary">
                ANEXAR
                <input type="file" id="arquivo" name="arquivos[]" accept=".jpg, .png, .jpeg, .gif, .bmp, .avi, .mp4, .pdf"
                  style="display: none;">
              </span>
            </label>
            <input type="text" class="form-control" readonly>
          </div>

          <div class="input-group">
            <label class="input-group-btn">
              <span class="btn btn-raised btn-primary">
                ANEXAR
                <input type="file" id="arquivo" name="arquivos[]" accept=".jpg, .png, .jpeg, .gif, .bmp, .avi, .mp4, .pdf"
                  style="display: none;">
              </span>
            </label>
            <input type="text" class="form-control" readonly>
          </div>

          <div class="input-group">
            <label class="input-group-btn">
              <span class="btn btn-raised btn-primary">
                ANEXAR
                <input type="file" id="arquivo" name="arquivos[]" accept=".jpg, .png, .jpeg, .gif, .bmp, .avi, .mp4, .pdf"
                  style="display: none;">
              </span>
            </label>
            <input type="text" class="form-control" readonly>
          </div>

          <br>

          <center>
            <button type="submit" name="submit" class="btn btn-raised btn-primary btn-lg">SALVAR EXAME</button>
          </center>

        </form>

      </div>
    </div>
  </div>
>>>>>>> consucloud-2/master

</body>

</html>