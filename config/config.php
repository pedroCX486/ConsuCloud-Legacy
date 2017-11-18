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
</head>

<body>

  <div class="container">
    <div class="jumbotron">
      <h1>Configurações</h1>
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
                    <span class="input-group-addon" id="basic-addon1">Logradouro:*</span>
                    <input required type="text" class="form-control" name="endereco_logradouro" aria-describedby="basic-addon1" maxlength="150"
                      value="<?php echo $endereco_logradouro; ?>">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Número:*</span>
                    <input required type="text" class="form-control" name="endereco_numero" aria-describedby="basic-addon1" maxlength="10" value="<?php echo $endereco_numero; ?>">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Complemento:</span>
                    <input type="text" class="form-control" name="endereco_complemento" aria-describedby="basic-addon1" maxlength="20" value="<?php echo $endereco_complemento; ?>">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Bairro:*</span>
                    <input required type="text" class="form-control" name="endereco_bairro" aria-describedby="basic-addon1" maxlength="100" value="<?php echo $endereco_bairro; ?>">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Cidade:*</span>
                    <input required type="text" class="form-control" name="endereco_cidade" aria-describedby="basic-addon1" maxlength="100" value="<?php echo $endereco_cidade; ?>">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">CEP:*</span>
                    <input required type="text" class="form-control" name="endereco_cep" aria-describedby="basic-addon1" maxlength="8" value="<?php echo $endereco_cep; ?>">
                  </div>

                  <div class="form-group">
                    <select required name="endereco_estado" class="form-control">
                      <option value="Acre" <?php if($endereco_estado=='Acre' ){echo 'selected';} ?>>Acre</option>
                      <option value="Alagoas" <?php if($endereco_estado=='Alagoas' ){echo 'selected';} ?>>Alagoas</option>
                      <option value="Amapá" <?php if($endereco_estado=='Amapá' ){echo 'selected';} ?>>Amapá</option>
                      <option value="Amazonas" <?php if($endereco_estado=='Amazonas' ){echo 'selected';} ?>>Amazonas</option>
                      <option value="Bahia" <?php if($endereco_estado=='Bahia' ){echo 'selected';} ?>>Bahia</option>
                      <option value="Ceará" <?php if($endereco_estado=='Ceará' ){echo 'selected';} ?>>Ceará</option>
                      <option value="Distrito Federal" <?php if($endereco_estado=='Distrito Federal' ){echo 'selected';} ?>>Distrito Federal</option>
                      <option value="Espírito Santo" <?php if($endereco_estado=='Espírito Santo' ){echo 'selected';} ?>>Espírito Santo</option>
                      <option value="Goiás" <?php if($endereco_estado=='Goiás' ){echo 'selected';} ?>>Goiás</option>
                      <option value="Maranhão" <?php if($endereco_estado=='Maranhão' ){echo 'selected';} ?>>Maranhão</option>
                      <option value="Mato Grosso" <?php if($endereco_estado=='Mato Grosso' ){echo 'selected';} ?>>Mato Grosso</option>
                      <option value="Mato Grosso do Sul" <?php if($endereco_estado=='Mato Grosso do Sul' ){echo 'selected';} ?>>Mato Grosso do Sul</option>
                      <option value="Minas Gerais" <?php if($endereco_estado=='Minas Gerais' ){echo 'selected';} ?>>Minas Gerais</option>
                      <option value="Pará" <?php if($endereco_estado=='Pará' ){echo 'selected';} ?>>Pará</option>
                      <option value="Paraíba" <?php if($endereco_estado=='Paraíba' ){echo 'selected';} ?>>Paraíba</option>
                      <option value="Paraná" <?php if($endereco_estado=='Paraná' ){echo 'selected';} ?>>Paraná</option>
                      <option value="Pernambuco" <?php if($endereco_estado=='Pernambuco' ){echo 'selected';} ?>>Pernambuco</option>
                      <option value="Piauí" <?php if($endereco_estado=='Piauí' ){echo 'selected';} ?>>Piauí</option>
                      <option value="Rio de Janeiro" <?php if($endereco_estado=='Rio de Janeiro' ){echo 'selected';} ?>>Rio de Janeiro</option>
                      <option value="Rio Grande do Norte" <?php if($endereco_estado=='Rio Grande do Norte' ){echo 'selected';} ?>>Rio Grande do Norte</option>
                      <option value="Rio Grande do Sul" <?php if($endereco_estado=='Rio Grande do Sul' ){echo 'selected';} ?>>Rio Grande do Sul</option>
                      <option value="Rondônia" <?php if($endereco_estado=='Rondônia' ){echo 'selected';} ?>>Rondônia</option>
                      <option value="Roraima" <?php if($endereco_estado=='Roraima' ){echo 'selected';} ?>>Roraima</option>
                      <option value="Santa Catarina" <?php if($endereco_estado=='Santa Catarina' ){echo 'selected';} ?>>Santa Catarina</option>
                      <option value="São Paulo" <?php if($endereco_estado=='São Paulo' ){echo 'selected';} ?>>São Paulo</option>
                      <option value="Sergipe" <?php if($endereco_estado=='Sergipe' ){echo 'selected';} ?>>Sergipe</option>
                      <option value="Tocantins" <?php if($endereco_estado=='Tocantins' ){echo 'selected';} ?>>Tocantins</option>
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