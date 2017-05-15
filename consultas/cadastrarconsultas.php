<?php
require("../assets/connect.php");

session_start();

if($_SESSION["isMedico"] == true || !$_SESSION){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
 }elseif(empty($_SESSION)){
    header("Location: ../logout.php");
    exit();
}
?>

  <!DOCTYPE html>
  <html>

  <head>
   <meta charset="UTF-8">
   <title>Consultas - ConsuCloud</title>
    
   <?php include "../assets/bootstrap.php";?>
</head>

<body>

<?php include "../barra.php"; ?>

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
        <h1><small>Cadastrar Consultas</small></h1><br>
        <div class="cadastro">

          <form method="post" action="cadastrar.php">
		  
            <div class="form-group">
              <select required name="paciente" class="form-control">
            <option disabled selected value="">Nome do Paciente*</option>
            <?php
            $select = $mysqli->query("SELECT * FROM pacientes");
              $row = $select->num_rows;
              if($row){              
                while($get = $select->fetch_array()){
            ?>
            <option value="<?php echo $get['numIdRG']; ?>" ><?php echo $get['numIdRG'] . " - " . $get['nomeComp']; ?></option>
            <?php
                }
              }
            ?>
            </select>
            </div>

            <div class="row">
              <div class="col-lg-6">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Data da Consulta:*</span>
                  <input required type="date" class="form-control" name="dataConsulta" aria-describedby="basic-addon1" max="9999-12-31" maxlength="10" OnKeyPress="formatar('##/##/####', this)">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Hora da Consulta:*</span>
                  <input required type="time" class="form-control" name="horaConsulta" aria-describedby="basic-addon1" maxlength="5" OnKeyPress="formatar('##:##', this)">
                </div>
              </div>
            </div>

            <p>
              <div class="form-group">
                <select required name="medico" class="form-control">
                <option disabled selected value="">Médico da Consulta*</option>
            <?php
            $select = $mysqli->query("SELECT * FROM usuarios WHERE tipoUsuario = 'Medico'");
            $row = $select->num_rows;
              if($row){              
                while($get = $select->fetch_array()){
            ?>
                <option value="<?php echo $get['crm']; ?>" ><?php echo $get['nomeComp']; ?></option>
            <?php
                }
              }
            ?>
                </select>
              </div>
            </p>

            <div class="form-group">
              <select required name="planoConsulta" class="form-control">
          <option disabled selected value="">Plano de Consulta*</option>
            <?php        
            $select = $mysqli->query("SELECT * FROM planos");
            $row = $select->num_rows;
              if($row){              
                while($get = $select->fetch_array()){
            ?>
          <option value="<?php echo $get['id']; ?>" ><?php echo $get['nomePlano']; ?></option>
            <?php
                }
              }
            ?>
          </select>
            </div>

            <p>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Número da Carteira do Plano:*</span>
                <input required type="text" class="form-control" name="carteiraPlano" aria-describedby="basic-addon1" maxlength="20" placeholder="Digite apenas números, sem pontos ou traços. Em caso de consulta particular, digite apenas o número 0 (ZERO).">
              </div>
            </p>

            <div class="form-group">
              <select required name="tipoConsulta" class="form-control">
            <option disabled selected value="">Tipo de Consulta*</option>
            <option value="primeiraConsulta">Primeira Consulta</option>
            <option value="retorno">Retorno</option>
            </select>
            </div>

            <br>

            <center><button type="submit" class="btn btn-raised btn-primary btn-lg">CADASTRAR CONSULTA</button></center>

          </form>

        </div>
      </div>
    </div>

  </body>

  </html>