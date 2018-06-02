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
              <option value="AC">Acre</option>
              <option value="AL">Alagoas</option>
              <option value="AP">Amapá</option>
              <option value="AM">Amazonas</option>
              <option value="BA">Bahia</option>
              <option value="CE">Ceará</option>
              <option value="DF">Distrito Federal</option>
              <option value="ES">Espírito Santo</option>
              <option value="GO">Goiás</option>
              <option value="MA">Maranhão</option>
              <option value="MT">Mato Grosso</option>
              <option value="MS">Mato Grosso do Sul</option>
              <option value="MG">Minas Gerais</option>
              <option value="PA">Pará</option>
              <option value="PB">Paraíba</option>
              <option value="PR">Paraná</option>
              <option value="PE">Pernambuco</option>
              <option value="PI">Piauí</option>
              <option value="RJ">Rio de Janeiro</option>
              <option value="RN">Rio Grande do Norte</option>
              <option value="RS">Rio Grande do Sul</option>
              <option value="RR">Rondônia</option>
              <option value="RR">Roraima</option>
              <option value="SC">Santa Catarina</option>
              <option value="SP">São Paulo</option>
              <option value="SE">Sergipe</option>
              <option value="TO">Tocantins</option> 
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