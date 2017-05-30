<?php
session_start();

if($_SESSION["isSecretaria"] == true || $_SESSION["isMedico"] == true){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
 }elseif(empty($_SESSION)){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Planos de Saúde - ConsuCloud</title>
    
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
        <h1><small>Cadastrar Plano de Saúde</small></h1><br>
        <div class="cadastro">
          <form method="post" action="cadastrar.php">

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Nome do Plano:*</span>
              <input required type="text" class="form-control" name="nomePlano" aria-describedby="basic-addon1" maxlength="150">
            </div>

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Telefone:*</span>
              <input required type="text" class="form-control" name="telFixo" aria-describedby="basic-addon1" placeholder="00 12345678" maxlength="11" OnKeyPress="formatar('## ########', this)">
            </div>

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Email:*</span>
              <input required type="text" class="form-control" name="email" aria-describedby="basic-addon1" maxlength="150">
            </div>

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Informação sobre:*</span>
              <input required type="text" class="form-control" name="infoPlano" aria-describedby="basic-addon1" maxlength="200">
            </div>

            <div class="panel-group" id="accordion">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Endereço ▾</a>
              </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                  <div class="panel-body">

                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">Logradouro:*</span>
                      <input required type="text" class="form-control" name="endereco_logradouro" aria-describedby="basic-addon1" maxlength="150">
                    </div>

                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">Número:*</span>
                      <input required type="text" class="form-control" name="endereco_numero" aria-describedby="basic-addon1" maxlength="10">
                    </div>

                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">Complemento:</span>
                      <input type="text" class="form-control" name="endereco_complemento" aria-describedby="basic-addon1" maxlength="20">
                    </div>

                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">Bairro:*</span>
                      <input required type="text" class="form-control" name="endereco_bairro" aria-describedby="basic-addon1" maxlength="100">
                    </div>

                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">Cidade:*</span>
                      <input required type="text" class="form-control" name="endereco_cidade" aria-describedby="basic-addon1" maxlength="100">
                    </div>

                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">CEP:*</span>
                      <input required type="text" class="form-control" name="endereco_cep" aria-describedby="basic-addon1" maxlength="8" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                    </div>

                    <div class="form-group">
                      <select required name="endereco_estado" class="form-control">
                          <option disabled selected value="">Estado ▾*</option>
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

            <center><button type="submit" class="btn btn-raised btn-primary btn-lg">CADASTRAR</button></center>

          </form>

        </div>
      </div>
    </div>

  </body>

  </html>