<?php
session_start();

if(!$_SESSION["isAdmin"] || empty($_SESSION["idUsuario"])){
  echo "<script>top.window.location = '".$_SESSION["installAddress"]."index.php?erro=ERROFATAL'</script>";
  die();
}

require($_SESSION["installFolder"]."componentes/sessionbuster.php");

require($_SESSION["installFolder"]."componentes/db/connect.php");

$idPlano = trim(addslashes(strip_tags($_GET['editar'])));

$select = $mysqli->query("SELECT * FROM planos WHERE idPlano = $idPlano");
$row = $select->num_rows;
if($row){              
  while($get = $select->fetch_array()){
    $nomePlano = $get['nomePlano'];
    $telFixo = $get['telFixo'];
    $email = $get['email'];
    $infoPlano = $get['infoPlano'];
    $endereco_logradouro = $get['endereco_logradouro'];
    $endereco_numero = $get['endereco_numero'];
    $endereco_complemento = $get['endereco_complemento'];
    $endereco_bairro = $get['endereco_bairro'];
    $endereco_cidade = $get['endereco_cidade'];
    $endereco_cep = $get['endereco_cep'];
    $endereco_estado = $get['endereco_estado'];
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Planos de Saúde - ConsuCloud</title>

  <?php include $_SESSION["installFolder"]."componentes/boot.php";?>
  <script src="<?php echo $_SESSION["installAddress"]; ?>componentes/maskFormat.js"></script>
  <script src="<?php echo $_SESSION["installAddress"]; ?>componentes/buscaCEP.js"></script>
</head>

<body>
  
  <?php include $_SESSION["installFolder"]."componentes/barra.php"; ?>
  
  <div class="container">
    <div class="jumbotron">
      <h1>
        <small>Editar Plano de Saúde</small>
         <a href="planos.php">
          <button class="btn btn-raised btn-danger pull-right" onClick="return confirm('Tem certeza que deseja sair?')">CANCELAR EDIÇÃO</button>
        </a>
      </h1>
      <br>
      <div class="cadastro">

        <form method="post" action="editar.php">

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Nome do Plano:*</span>
            <input required type="text" class="form-control" name="nomePlano" aria-describedby="basic-addon1" value="<?php echo $nomePlano; ?>"
              maxlength="150">
          </div>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Telefone:</span>
            <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" name="telFixo" aria-describedby="basic-addon1"
              placeholder="00 12345678" maxlength="11" OnKeyPress="formatar('## ########', this)" value="<?php echo $telFixo; ?>">
          </div>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Email:</span>
            <input type="text" class="form-control" name="email" aria-describedby="basic-addon1" value="<?php echo $email; ?>" maxlength="150"
              pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="exemplo@exemplo.com">
          </div>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Informação sobre:</span>
            <input type="text" class="form-control" name="infoPlano" aria-describedby="basic-addon1" value="<?php echo $infoPlano; ?>"
              maxlength="200">
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
                    <input type="text" class="form-control" name="endereco_cep" id="cep" aria-describedby="basic-addon1" maxlength="8" pattern="([0-9]){2,}" title="12345678 (Apenas Números)" value="<?php echo $endereco_cep; ?>">
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-raised btn-info pull-right" id="buscaCEP">BUSCAR CEP</button>
                    </div>
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Logradouro:</span>
                    <input type="text" class="form-control" name="endereco_logradouro" id="logradouro" aria-describedby="basic-addon1" value="<?php echo $endereco_logradouro; ?>"
                      maxlength="150">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Número:</span>
                    <input type="text" class="form-control" name="endereco_numero" aria-describedby="basic-addon1" value="<?php echo $endereco_numero; ?>"
                      maxlength="10" pattern="([0-9]){1,}" title="12345678 (Apenas Números)">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Complemento:</span>
                    <input type="text" class="form-control" name="endereco_complemento" aria-describedby="basic-addon1" value="<?php echo $endereco_complemento; ?>"
                      maxlength="20">
                  </div>

                  <div class="input-group">
										<span class="input-group-addon" id="basic-addon1">Bairro:</span>
                      <input type="text" class="form-control" name="endereco_bairro" id="bairro" aria-describedby="basic-addon1" value="<?php echo $endereco_bairro; ?>"
                        maxlength="100">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Cidade:</span>
                    <input type="text" class="form-control" name="endereco_cidade" id="cidade" aria-describedby="basic-addon1" value="<?php echo $endereco_cidade; ?>"
                      maxlength="100">
                  </div>

                  <div class="form-group">
                    <select name="endereco_estado" id="uf" class="form-control">
											<option disabled selected value="">Estado ▾</option>
                      <option value="AC" <?php if($endereco_estado=='AC' ){echo 'selected';} ?>>Acre</option>
                      <option value="AL" <?php if($endereco_estado=='AL' ){echo 'selected';} ?>>Alagoas</option>
                      <option value="AP" <?php if($endereco_estado=='AP' ){echo 'selected';} ?>>Amapá</option>
                      <option value="AM" <?php if($endereco_estado=='AM' ){echo 'selected';} ?>>Amazonas</option>
                      <option value="BA" <?php if($endereco_estado=='BA' ){echo 'selected';} ?>>Bahia</option>
                      <option value="CE" <?php if($endereco_estado=='CE' ){echo 'selected';} ?>>Ceará</option>
                      <option value="DF" <?php if($endereco_estado=='DF' ){echo 'selected';} ?>>Distrito Federal</option>
                      <option value="ES" <?php if($endereco_estado=='ES' ){echo 'selected';} ?>>Espírito Santo</option>
                      <option value="GO" <?php if($endereco_estado=='GO' ){echo 'selected';} ?>>Goiás</option>
                      <option value="MA" <?php if($endereco_estado=='MA' ){echo 'selected';} ?>>Maranhão</option>
                      <option value="MT" <?php if($endereco_estado=='MT' ){echo 'selected';} ?>>Mato Grosso</option>
                      <option value="MS" <?php if($endereco_estado=='MS' ){echo 'selected';} ?>>Mato Grosso do Sul</option>
                      <option value="MG" <?php if($endereco_estado=='MG' ){echo 'selected';} ?>>Minas Gerais</option>
                      <option value="PA" <?php if($endereco_estado=='PA' ){echo 'selected';} ?>>Pará</option>
                      <option value="PB" <?php if($endereco_estado=='PB' ){echo 'selected';} ?>>Paraíba</option>
                      <option value="PR" <?php if($endereco_estado=='PR' ){echo 'selected';} ?>>Paraná</option>
                      <option value="PE" <?php if($endereco_estado=='PE' ){echo 'selected';} ?>>Pernambuco</option>
                      <option value="PI" <?php if($endereco_estado=='PI' ){echo 'selected';} ?>>Piauí</option>
                      <option value="RJ" <?php if($endereco_estado=='RJ' ){echo 'selected';} ?>>Rio de Janeiro</option>
                      <option value="RN" <?php if($endereco_estado=='RN' ){echo 'selected';} ?>>Rio Grande do Norte</option>
                      <option value="RS" <?php if($endereco_estado=='RS' ){echo 'selected';} ?>>Rio Grande do Sul</option>
                      <option value="RR" <?php if($endereco_estado=='RR' ){echo 'selected';} ?>>Rondônia</option>
                      <option value="RR" <?php if($endereco_estado=='RR' ){echo 'selected';} ?>>Roraima</option>
                      <option value="SC" <?php if($endereco_estado=='SC' ){echo 'selected';} ?>>Santa Catarina</option>
                      <option value="SP" <?php if($endereco_estado=='SP' ){echo 'selected';} ?>>São Paulo</option>
                      <option value="SE" <?php if($endereco_estado=='SE' ){echo 'selected';} ?>>Sergipe</option>
                      <option value="TO" <?php if($endereco_estado=='TO' ){echo 'selected';} ?>>Tocantins</option>
                    </select>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <br>
          <br>

          <input type="hidden" name="idPlano" value="<?php echo $idPlano; ?>">

          <center>
            <button type="submit" class="btn btn-raised btn-primary btn-lg">ATUALIZAR</button>
          </center>

        </form>

      </div>
    </div>
  </div>

</body>

</html>