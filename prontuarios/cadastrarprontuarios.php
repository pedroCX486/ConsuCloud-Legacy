<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Prontuários - ConsuCloud</title>
    
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
        <h1><small>Cadastrar Prontuário</small></h1><br>

          <form method="post" action="">

            <div class="form-group">
              <select required name="paciente" class="form-control">
              <option disabled selected value="">Nome do Paciente*</option>
              </select>
            </div>

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Data da Consulta:*</span>
              <input required type="date" class="form-control" name="dataProntuario" aria-describedby="basic-addon1" maxlength="10" max="9999-12-31" OnKeyPress="formatar('##/##/####', this)">
            </div>

            <br>

            <div class="form-group">
              <label id="prontuario">Prontuário</label>
              <textarea required name="prontuario" class="form-control" rows="10"></textarea>
            </div>

            <br>

            <center><button type="submit" class="btn btn-raised btn-primary btn-lg">SALVAR PRONTUÁRIO</button></center>

          </form>

      </div>
    </div>

  </body>

  </html>