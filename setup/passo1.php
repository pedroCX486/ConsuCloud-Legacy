<?php
include "../componentes/boot.php";
?>

  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title>ConsuCloud</title>
  </head>

  <style>
    body {
      margin-top: 30px;
    }
    
    div.input-group {
      margin-bottom: 5px;
    }
  </style>

  <body>

    <div class="container">
      <div class="jumbotron">

        <p>
          <center><img src="../assets/minibrand.png" align="right"></center>
        </p>
        <br><br>

        <form method="post" action="passo1executar.php">
          <p>
            Primeiramente, qual o nome do seu consultório?*
          </p>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"></span>
            <input required type="text" class="form-control" aria-describedby="basic-addon1" name="nomeConsultorio" maxlength="150">
          </div>
          <br><br>

          <p>
            Qual o email do consultório?*
          </p>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"></span>
            <input required type="text" class="form-control" aria-describedby="basic-addon1" name="email" maxlength="100">
          </div>
          <br><br>

          <p>
            Quais são os telefones de contato?*
          </p>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"></span>
            <input required type="text" class="form-control" placeholder="Exemplo: (00) 1234-5678 e (00) 1234-5678" aria-describedby="basic-addon1" name="telefone" maxlength="100">
          </div>
          <br><br>

          <p>
            E o endereço do consultório?*
          </p>

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
            <input required type="text" class="form-control" name="endereco_cep" aria-describedby="basic-addon1" maxlength="8">
          </div>

          <div class="form-group">
            <select required name="endereco_estado" class="form-control">
                          <option disabled selected value="">Estado*</option>
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

          <br><br>
          <button type="submit" class="btn btn-raised btn-primary btn-lg pull-right">Passo 2 >></button>
          <br>

        </form>
      </div>
    </div>

  </body>

  </html>