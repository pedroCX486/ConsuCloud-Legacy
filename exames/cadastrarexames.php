<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Exames - ConsuCloud</title>

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
    <h1><small>Cadastrar Exame</small></h1><br>

    <div class="cadastro">

      <form method="post" action="cadastrarexames.php" enctype="multipart/form-data">

        <div class="form-group">
          <select required name="paciente" class="form-control">
              <option disabled selected value="">Nome do Paciente*</option>
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

        <script src="../assets/fileSelect.js"></script>

        <br>Tamanho máximo: 10MB/Arquivo (50MB somando todos os arquivos.)<br><br>

        <div class="input-group">
          <label class="input-group-btn">
                    <span class="btn btn-raised btn-primary">
                        ANEXAR <input type="file" id="arquivo" name="arquivos[]" style="display: none;" multiple>
                    </span>
                </label>
          <input type="text" class="form-control" readonly>
        </div>

        <div class="input-group">
          <label class="input-group-btn">
                    <span class="btn btn-raised btn-primary">
                        ANEXAR <input type="file" id="arquivo" name="arquivos[]" style="display: none;" multiple>
                    </span>
                </label>
          <input type="text" class="form-control" readonly>
        </div>

        <div class="input-group">
          <label class="input-group-btn">
                    <span class="btn btn-raised btn-primary">
                        ANEXAR <input type="file" id="arquivo" name="arquivos[]" style="display: none;" multiple>
                    </span>
                </label>
          <input type="text" class="form-control" readonly>
        </div>

        <div class="input-group">
          <label class="input-group-btn">
                    <span class="btn btn-raised btn-primary">
                        ANEXAR <input type="file" id="arquivo" name="arquivos[]" style="display: none;" multiple>
                    </span>
                </label>
          <input type="text" class="form-control" readonly>
        </div>

        <div class="input-group">
          <label class="input-group-btn">
                    <span class="btn btn-raised btn-primary">
                        ANEXAR <input type="file" id="arquivo" name="arquivos[]" style="display: none;" multiple>
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

</body>

</html>