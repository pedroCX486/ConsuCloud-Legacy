<?php
session_start();

if($_SESSION["isSecretaria"] == true || $_SESSION["isMedico"] == true || !$_SESSION){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
}elseif(empty($_SESSION)){
    header("Location: ../logout.php");
    exit();
}

require "../assets/connect.php";

if($_GET['editar'] == 'debugBackdoor' || $_GET['editar'] == 'SysAdmin'){
  header("Location: ../index.php?erro=ERROFATAL");
  exit();
}else{
  $edit = trim(addslashes(strip_tags($_GET['editar'])));
}

$select = $mysqli->query("SELECT * FROM usuarios WHERE crm = $edit");
$row = $select->num_rows;
if($row){
  while($get = $select->fetch_array()){
    $crm = $get['crm'];
    $tipoUsuario = $get['tipoUsuario'];
    $contaAtiva = $get['contaAtiva'];
    $nomeComp = $get['nomeComp'];
    $areaAtuacao = $get['areaAtuacao'];
    $numIdRG = $get['numIdRG'];
    $RG_UFEXP = $get['RG_UFEXP'];
    $dataNasc = $get['dataNasc'];
    $telCel = $get['telCel'];
    $telFixo = $get['telFixo'];
    $email = $get['email'];
    $nomeCurto = $get['nomeCurto'];
    $endereco_logradouro = $get['endereco_logradouro'];
    $endereco_numero = $get['endereco_numero'];
    $endereco_complemento = $get['endereco_complemento'];
    $endereco_bairro = $get['endereco_bairro'];
    $endereco_cidade = $get['endereco_cidade'];
    $endereco_cep = $get['endereco_cep'];
    $endereco_estado = $get['endereco_estado'];
    $login = $get['login'];

    $mysqli->close();
  }
}

if(stripos($_SERVER["HTTP_USER_AGENT"], 'Firefox') !== false) {$dataNasc = date("d/m/Y", strtotime($dataNasc));}
?>

  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title>Usuários - ConsuCloud</title>

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
        <h1><small>Editar Usuário</small></h1><br>
        <div class="cadastro">

          <form method="post" action="editar.php">

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"><?php if($tipoUsuario == 'medico'){echo "CRM (Médicos)";} else{echo "CPF (Secretárias)";} ?>:</span>
              <input required type="text" class="form-control" name="crm" aria-describedby="basic-addon1" maxlength="20" value="<?php echo $crm; ?>" readonly>
            </div>
			
			      <br>

            <div class="alert alert-warning" id="rcorners2" role="alert">
              <b>Conta Ativada:</b>
              <p>
                &nbsp;
                <label style="color: black"><input required type="radio" name="contaAtiva" value="1" <?php if($contaAtiva == '1'){echo 'checked';} ?>> Sim</label> &nbsp;
                <label style="color: black"><input required type="radio" name="contaAtiva" value="0" <?php if($contaAtiva == '0'){echo 'checked';} ?>> Não</label>
              </p>
            </div>

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Nome Completo:*</span>
              <input required type="text" class="form-control" name="nomeComp" aria-describedby="basic-addon1" value="<?php echo $nomeComp; ?>" maxlength="150">
            </div>

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Área de Atuação:*</span>
              <input required type="text" class="form-control" name="areaAtuacao" aria-describedby="basic-addon1" value="<?php echo $areaAtuacao; ?>" maxlength="150">
            </div>

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Data de Nascimento:*</span>
              <input required type="date" class="form-control" name="dataNasc" aria-describedby="basic-addon1" max="9999-12-31" maxlength="10" value="<?php echo $dataNasc; ?>" OnKeyPress="formatar('##/##/####', this)">
            </div>

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Telefone Fixo:</span>
              <input type="text" class="form-control" name="telFixo" aria-describedby="basic-addon1" placeholder="00 12345678" maxlength="11" OnKeyPress="formatar('## ########', this)" value="<?php echo $telFixo; ?>">
            </div>

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Telefone Celular:*</span>
              <input required type="text" class="form-control" name="telCel" aria-describedby="basic-addon1" placeholder="00 012345678" maxlength="12" OnKeyPress="formatar('## #########', this)" value="<?php echo $telCel; ?>">
            </div>

            <div class="row">
              <div class="col-lg-6">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Número da Identidade/RG:*</span>
                  <input required type="text" class="form-control" name="numIdRG" aria-describedby="basic-addon1" maxlength="20" value="<?php echo $numIdRG; ?>" readonly>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Orgão Expedidor/UF:*</span>
                  <input required type="text" class="form-control" name="RG_UFEXP" aria-describedby="basic-addon1" maxlength="10" value="<?php echo $RG_UFEXP; ?>" readonly>
                </div>
              </div>
            </div>

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Email:*</span>
              <input required type="text" class="form-control" name="email" aria-describedby="basic-addon1" value="<?php echo $email; ?>" maxlength="100">
            </div>

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Nome Curto:*</span>
              <input required type="text" class="form-control" name="nomeCurto" aria-describedby="basic-addon1" placeholder="Para exibição no sistema, exemplo: Dr. João Cláudio" maxlength="25" value="<?php echo $nomeCurto; ?>">
            </div>

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Login:</span>
              <input type="text" class="form-control" name="login" aria-describedby="basic-addon1" placeholder="Apenas altere este campo em caso de necessidade." maxlength="30" value="<?php echo $login; ?>">
            </div>

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Senha:</span>
              <input type="password" class="form-control" name="senha" aria-describedby="basic-addon1" placeholder="Apenas altere este campo em caso de necessidade." maxlength="20">
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
                      <input required type="text" class="form-control" name="endereco_logradouro" aria-describedby="basic-addon1" value="<?php echo $endereco_logradouro; ?>" maxlength="150">
                    </div>

                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">Número:*</span>
                      <input required type="text" class="form-control" name="endereco_numero" aria-describedby="basic-addon1" value="<?php echo $endereco_numero; ?>" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                    </div>

                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">Complemento:</span>
                      <input type="text" class="form-control" name="endereco_complemento" aria-describedby="basic-addon1" value="<?php echo $endereco_complemento; ?>" maxlength="20">
                    </div>

                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">Bairro:*</span>
                      <input required type="text" class="form-control" name="endereco_bairro" aria-describedby="basic-addon1" value="<?php echo $endereco_bairro; ?>" maxlength="100">
                    </div>

                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">Cidade:*</span>
                      <input required type="text" class="form-control" name="endereco_cidade" aria-describedby="basic-addon1" value="<?php echo $endereco_cidade; ?>" maxlength="100">
                    </div>

                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">CEP:*</span>
                      <input required type="text" class="form-control" name="endereco_cep" aria-describedby="basic-addon1" maxlength="8" value="<?php echo $endereco_cep; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                    </div>

                    <div class="form-group">
                      <select name="endereco_estado" class="form-control">
                          <option value="AC" <?php if($endereco_estado == 'AC'){echo 'selected';} ?>>Acre</option>
                          <option value="AL" <?php if($endereco_estado == 'AL'){echo 'selected';} ?>>Alagoas</option>
                          <option value="AP" <?php if($endereco_estado == 'AP'){echo 'selected';} ?>>Amapá</option>
                          <option value="AM" <?php if($endereco_estado == 'AM'){echo 'selected';} ?>>Amazonas</option>
                          <option value="BA" <?php if($endereco_estado == 'BA'){echo 'selected';} ?>>Bahia</option>
                          <option value="CE" <?php if($endereco_estado == 'CE'){echo 'selected';} ?>>Ceará</option>
                          <option value="DF" <?php if($endereco_estado == 'DF'){echo 'selected';} ?>>Distrito Federal</option>
                          <option value="ES" <?php if($endereco_estado == 'ES'){echo 'selected';} ?>>Espírito Santo</option>
                          <option value="GO" <?php if($endereco_estado == 'GO'){echo 'selected';} ?>>Goiás</option>
                          <option value="MA" <?php if($endereco_estado == 'MA'){echo 'selected';} ?>>Maranhão</option>
                          <option value="MT" <?php if($endereco_estado == 'MT'){echo 'selected';} ?>>Mato Grosso</option>
                          <option value="MS" <?php if($endereco_estado == 'MS'){echo 'selected';} ?>>Mato Grosso do Sul</option>
                          <option value="MG" <?php if($endereco_estado == 'MG'){echo 'selected';} ?>>Minas Gerais</option>
                          <option value="PA" <?php if($endereco_estado == 'PA'){echo 'selected';} ?>>Pará</option>
                          <option value="PB" <?php if($endereco_estado == 'PB'){echo 'selected';} ?>>Paraíba</option>
                          <option value="PR" <?php if($endereco_estado == 'PR'){echo 'selected';} ?>>Paraná</option>
                          <option value="PE" <?php if($endereco_estado == 'PE'){echo 'selected';} ?>>Pernambuco</option>
                          <option value="PI" <?php if($endereco_estado == 'PI'){echo 'selected';} ?>>Piauí</option>
                          <option value="RJ" <?php if($endereco_estado == 'RJ'){echo 'selected';} ?>>Rio de Janeiro</option>
                          <option value="RN" <?php if($endereco_estado == 'RN'){echo 'selected';} ?>>Rio Grande do Norte</option>
                          <option value="RS" <?php if($endereco_estado == 'RS'){echo 'selected';} ?>>Rio Grande do Sul</option>
                          <option value="RR" <?php if($endereco_estado == 'RR'){echo 'selected';} ?>>Rondônia</option>
                          <option value="RR" <?php if($endereco_estado == 'RR'){echo 'selected';} ?>>Roraima</option>
                          <option value="SC" <?php if($endereco_estado == 'SC'){echo 'selected';} ?>>Santa Catarina</option>
                          <option value="SP" <?php if($endereco_estado == 'SP'){echo 'selected';} ?>>São Paulo</option>
                          <option value="SE" <?php if($endereco_estado == 'SE'){echo 'selected';} ?>>Sergipe</option>
                          <option value="TO" <?php if($endereco_estado == 'TO'){echo 'selected';} ?>>Tocantins</option>
                    </select>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            <br>
            <br>

            <center><button type="submit" class="btn btn-raised btn-primary btn-lg">ATUALIZAR</button></center>

          </form>
        </div>
      </div>
    </div>

  </body>

  </html>
