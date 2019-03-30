<?php
  session_start();

  if(!$_SESSION["isAdmin"] || empty($_SESSION["idUsuario"])){
    include("../componentes/redirect.php");
  }

  require($_SESSION["installFolder"]."componentes/sessionbuster.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Usuários - ConsuCloud</title>

  <?php include $_SESSION["installFolder"]."componentes/boot.php";?>
  <script src="<?php echo $_SESSION["installAddress"]; ?>componentes/maskFormat.js"></script>
  <script src="<?php echo $_SESSION["installAddress"]; ?>componentes/tabCadastro.js"></script>
  <script src="<?php echo $_SESSION["installAddress"]; ?>componentes/buscaCEP.js"></script>
</head>

<body>
  
  <?php include $_SESSION["installFolder"]."componentes/barra.php"; ?>
  
  <div class="container">
    <div class="jumbotron">
      <h1>
        <small>Cadastrar Usuário</small>
        <a href="usuarios.php">
          <button class="btn btn-raised btn-danger pull-right" onClick="return confirm('Tem certeza que deseja sair?')">CANCELAR CADASTRO</button>
        </a>
      </h1>
      <br>
      <div class="cadastro">

        <form method="post" action="cadastrar.php">
          
          <div class="alert alert-info" id="rcorners2" role="alert">
            <b>Tipo de Cadastro:</b>
            <p>
              &nbsp;
              <label style="color: black">
              <input required type="radio" name="tipoUsuario" value="medico" onClick="showMedico();" checked/> Médico 
              
                &nbsp;
              <label style="color: black">
              <input required type="radio" name="tipoUsuario" value="secretaria" onClick="showSecretaria();"/> Atendimento
            </p>
          </div>

          <div class="input-group" id="divCRM" style="display: inline-table;">
            <span class="input-group-addon" id="basic-addon1" style="color: black">
              <b>CRM</b>:*</span>
            <input required type="text" class="form-control validate" name="crm" id="crm" aria-describedby="basic-addon1" maxlength="20" pattern="([0-9]){2,}" title="12345678 (Apenas Números)">
          </div>
          
          <div class="input-group" id="divCPF" style="display: none;">
            <span class="input-group-addon" id="basic-addon1" style="color: black">
              <b>CPF</b>:*</span>
            <input disabled type="text" class="form-control validate" name="crm" id="cpf" aria-describedby="basic-addon1" maxlength="11" pattern="[0-9]{11}" title="Digite sem traços e pontos todos os 11 dígitos do CPF. Exemplo: 99999999999">
          </div>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Nome Completo:*</span>
            <input required type="text" class="form-control" name="nomeCompleto" id="nomeCompleto" aria-describedby="basic-addon1" maxlength="150" pattern="([A-zÀ-ž\s]){2,}" title="Dr João da Silva Filho (Apenas Letras)">
          </div>

          <div class="input-group" id="divAreaAtuacao">
            <span class="input-group-addon" id="basic-addon1">Área de Atuação:*</span>
            <input required type="text" class="form-control" name="areaAtuacao" id="areaAtuacao" aria-describedby="basic-addon1" maxlength="150" placeholder="Ex.: Médico-Cirurgião ou Dentista Cirurgião. Ou várias áreas juntas, ex.: Psiquiatra & Otorrino">
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

          <div class="row">
            <div class="col-lg-6">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Número da Identidade/RG:*</span>
                <input required type="text" class="form-control" name="RG" aria-describedby="basic-addon1" maxlength="20" pattern="([0-9]){2,}" title="12345678 (Apenas Números)">
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
            <span class="input-group-addon" id="basic-addon1">Email:*</span>
            <input required type="text" class="form-control" id="email" name="email" aria-describedby="basic-addon1" maxlength="100"
              pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="exemplo@exemplo.com">
          </div>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Nome Curto:*</span>
            <input required type="text" class="form-control" name="nomeCurto" id="nomeCurto" aria-describedby="basic-addon1" placeholder="Para exibição no sistema, exemplo: Dr. João Silva"
              maxlength="25" pattern="([A-zÀ-ž\s.]){2,}" title="Exemplo: Dr. João">
          </div>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Login:*</span>
            <input required type="text" class="form-control" name="login" aria-describedby="basic-addon1" maxlength="30">
          </div>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Senha:*</span>
            <input required type="password" class="form-control" name="senha" aria-describedby="basic-addon1" maxlength="20" autocomplete="new-password">
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
                    <span class="input-group-addon" id="basic-addon1">CEP:</span>
                    <input type="text" class="form-control" name="endereco_cep" id="cep" aria-describedby="basic-addon1" maxlength="8" pattern="([0-9]){2,}" title="12345678 (Apenas Números)">
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-raised btn-info pull-right" id="buscaCEP">BUSCAR CEP</button>
                    </div>
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Logradouro:</span>
                    <input type="text" class="form-control" name="endereco_logradouro" id="logradouro" aria-describedby="basic-addon1" maxlength="150">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Número:</span>
                    <input type="text" class="form-control" name="endereco_numero" aria-describedby="basic-addon1" maxlength="10" pattern="([0-9]){1,}" title="12345678 (Apenas Números)">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Complemento:</span>
                    <input type="text" class="form-control" name="endereco_complemento" aria-describedby="basic-addon1" maxlength="20">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Bairro:</span>
                    <input type="text" class="form-control" name="endereco_bairro" id="bairro" aria-describedby="basic-addon1" maxlength="100">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Cidade:</span>
                    <input type="text" class="form-control" name="endereco_cidade" id="cidade" aria-describedby="basic-addon1" maxlength="100">
                  </div>

                  <div class="form-group">
                    <select name="endereco_estado" id="uf" class="form-control">
                      <option disabled selected value="">Estado ▾</option>
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

                </div>
              </div>
            </div>
          </div>

          <br>
          <br>

          <center>
            <button type="submit" class="btn btn-raised btn-primary btn-lg">CADASTRAR USUÁRIO</button>
          </center>

        </form>
      </div>
    </div>
  </div>

</body>

</html>