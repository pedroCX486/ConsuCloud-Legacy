<?php
session_start();

require("../componentes/sessionbuster.php");

if(!$_SESSION["isAdmin"]){
  echo "<script>top.window.location = '../index.php?erro=ERROFATAL'</script>";
  die;
 }elseif(empty($_SESSION)){
  echo "<script>top.window.location = '../index.php?erro=ERROFATAL'</script>";
  die;
}

require("../componentes/db/connect.php");

$select = $mysqli->query("SELECT * FROM configs");
$row = $select->num_rows;
if($row){              
  while($get = $select->fetch_array()){
    $nomeConsultorio = $get['nomeConsultorio'];
    $telefone = $get['telefone'];
    $email = $get['email'];
    $endereco_logradouro = $get['endereco_logradouro'];
    $endereco_numero = $get['endereco_numero'];
    $endereco_complemento = $get['endereco_complemento'];
    $endereco_bairro = $get['endereco_bairro'];
    $endereco_cidade = $get['endereco_cidade'];
    $endereco_cep = $get['endereco_cep'];
    $endereco_estado = $get['endereco_estado'];
    $logotipo = $get['logotipo'];
    $version = $get['version'];
  }
  
  $mysqli->close();
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Configurações - ConsuCloud</title>

  <?php include "../componentes/boot.php";?>
  <script src="../componentes/buscaCEP.js"></script>
</head>

<body>
  
  <?php include "../componentes/barra.php"; ?>

  <div class="container">
    <div class="jumbotron">
      <h1>Configurações</h1>
      <a class="anchor" href="../dashboards/dashboard.php">
        <button class="btn btn-raised btn-danger pull-right">VOLTAR AO INÍCIO</button>
      </a>
      <p>As informações básicas do consultório ficam aqui.</p>
      <br>
      <p>

        <form method="post" action="salvar.php" enctype="multipart/form-data">

          <div class="panel-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Informações Básicas do Consultório ▾</a>
                </h4>
              </div>
              <div id="collapse1" class="panel-collapse collapse">
                <div class="panel-body">

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Nome do Consultório:*</span>
                    <input required type="text" class="form-control" name="nomeConsultorio" maxlength="150" aria-describedby="basic-addon1" value="<?php echo $nomeConsultorio; ?>">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Telefone(s):*</span>
                    <input required type="text" class="form-control" name="telefone" aria-describedby="basic-addon1" maxlength="100" value="<?php echo $telefone; ?>"
                      placeholder="(00) 1234-5678 e (00) 1234-5678">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Email:*</span>
                    <input required type="text" class="form-control" name="email" aria-describedby="basic-addon1" maxlength="100" value="<?php echo $email; ?>">
                  </div>

                  <!--JS do FileSelect-->
                  <script src="../componentes/fileSelect.js"></script>

                  <div class="input-group">
                    <label class="input-group-btn">
                      <span class="btn btn-raised btn-primary">
                        LOGOTIPO (MÁX. 10MB)
                        <input type="file" id="arquivo" name="arquivos[]" accept=".jpg, .png, .jpeg, .gif, .bmp, .avi, .mp4, .pdf" style="display: none;">
                      </span>
                    </label>
                    <input type="text" class="form-control" placeholder="Arquivo atual: <?php echo $logotipo; ?> - Apenas altere em caso de necessidade."
                      readonly>
                  </div>

                </div>
              </div>
            </div>

            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Endereço do Consultório ▾</a>
                </h4>
              </div>
              <div id="collapse2" class="panel-collapse collapse">
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
                      maxlength="10" pattern="([0-9]){2,}" title="12345678 (Apenas Números)">
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


          <center>
            <button type="submit" class="btn btn-raised btn-primary btn-lg">SALVAR CONFIGURAÇÕES</button>
          </center>

        </form>

      </p>
      <br>

    </div>
  </div>

</body>

</html>