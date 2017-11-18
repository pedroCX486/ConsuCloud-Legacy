<?php
session_start();

require("../componentes/sessionbuster.php");

if($_SESSION["isMedico"]){
  echo "<script>top.window.location = '../index.php?erro=ERROFATAL'</script>";
  die;
 }elseif(empty($_SESSION)){
  echo "<script>top.window.location = '../index.php?erro=ERROFATAL'</script>";
  die;
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Pacientes - ConsuCloud</title>

  <?php include "../componentes/boot.php";?>
</head>

<body>

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
      <h1>
        <small>Cadastrar Paciente</small>
      </h1>
      <br>
      <div class="cadastro">
        <form method="post" action="cadastrar.php">

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Nome Completo:*</span>
            <input required type="text" class="form-control" name="nomePaciente" aria-describedby="basic-addon1" maxlength="150">
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Número da Identidade/RG:*</span>
                <input required type="text" class="form-control" name="RG" aria-describedby="basic-addon1" maxlength="20" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Orgão Expedidor/UF:*</span>
                <input required type="text" class="form-control" name="RGUFEXP" aria-describedby="basic-addon1" maxlength="10">
              </div>
            </div>
          </div>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Data de Nascimento:*</span>
            <input required type="date" class="form-control" name="dataNasc" aria-describedby="basic-addon1" max="9999-12-31" maxlength="10"
              OnKeyPress="formatar('##/##/####', this)">
          </div>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Telefone Fixo:</span>
            <input type="text" class="form-control" name="telFixo" aria-describedby="basic-addon1" placeholder="00 12345678" maxlength="11"
              OnKeyPress="formatar('## ########', this)">
          </div>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Telefone Celular:*</span>
            <input required type="text" class="form-control" name="telCel" aria-describedby="basic-addon1" placeholder="00 012345678"
              maxlength="12" OnKeyPress="formatar('## #########', this)">
          </div>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Email:</span>
            <input type="text" class="form-control" name="email" aria-describedby="basic-addon1" maxlength="100" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
              title="exemplo@exemplo.com">
          </div>

          <div class="panel-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Endereço ▾ (Opcional)</a>
                </h4>
              </div>
              <div id="collapse1" class="panel-collapse collapse">
                <div class="panel-body">

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Logradouro:</span>
                    <input type="text" class="form-control" name="endereco_logradouro" aria-describedby="basic-addon1" maxlength="150">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Número:</span>
                    <input type="text" class="form-control" name="endereco_numero" aria-describedby="basic-addon1" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Complemento:</span>
                    <input type="text" class="form-control" name="endereco_complemento" aria-describedby="basic-addon1" maxlength="20">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Bairro:</span>
                    <input type="text" class="form-control" name="endereco_bairro" aria-describedby="basic-addon1" maxlength="100">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Cidade:</span>
                    <input type="text" class="form-control" name="endereco_cidade" aria-describedby="basic-addon1" maxlength="100">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">CEP:</span>
                    <input type="text" class="form-control" name="endereco_cep" aria-describedby="basic-addon1" maxlength="8" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                  </div>

                  <div class="form-group">
                    <select name="endereco_estado" class="form-control">
                      <option disabled selected value="">Estado ▾</option>
                      <option value="Acre">Acre</option>
                      <option value="Alagoas">Alagoas</option>
                      <option value="Amapá">Amapá</option>
                      <option value="Amazonas">Amazonas</option>
                      <option value="Bahia">Bahia</option>
                      <option value="Ceará">Ceará</option>
                      <option value="Distrito Federal">Distrito Federal</option>
                      <option value="Espírito Santo">Espírito Santo</option>
                      <option value="Goiás">Goiás</option>
                      <option value="Maranhão">Maranhão</option>
                      <option value="Mato Grosso">Mato Grosso</option>
                      <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                      <option value="Minas Gerais">Minas Gerais</option>
                      <option value="Pará">Pará</option>
                      <option value="Paraíba">Paraíba</option>
                      <option value="Paraná">Paraná</option>
                      <option value="Pernambuco">Pernambuco</option>
                      <option value="Piauí">Piauí</option>
                      <option value="Rio de Janeiro">Rio de Janeiro</option>
                      <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                      <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                      <option value="Rondônia">Rondônia</option>
                      <option value="Roraima">Roraima</option>
                      <option value="Santa Catarina">Santa Catarina</option>
                      <option value="São Paulo">São Paulo</option>
                      <option value="Sergipe">Sergipe</option>
                      <option value="Tocantins">Tocantins</option>
                    </select>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <br>
          <br>

          <center>
            <button type="submit" class="btn btn-raised btn-primary btn-lg">CADASTRAR</button>
          </center>

        </form>

      </div>
    </div>
  </div>

</body>

</html>