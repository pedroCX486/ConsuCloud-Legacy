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

require("../componentes/db/connect.php");

$idPaciente = trim(addslashes(strip_tags($_GET['idPaciente'])));

$select = $mysqli->query("SELECT * FROM pacientes WHERE idPaciente = $idPaciente");
$row = $select->num_rows;
if($row){              
  while($get = $select->fetch_array()){
    $nomePaciente = $get['nomePaciente'];
    $RG = $get['RG'];
    $RGUFEXP = $get['RGUFEXP'];
    $dataNasc = $get['dataNasc'];
    $telCel = $get['telCel'];
    $telFixo = $get['telFixo'];
    $email = $get['email'];
    $endereco_logradouro = $get['endereco_logradouro'];
    $endereco_numero = $get['endereco_numero'];
    $endereco_complemento = $get['endereco_complemento'];
    $endereco_bairro = $get['endereco_bairro'];
    $endereco_cidade = $get['endereco_cidade'];
    $endereco_cep = $get['endereco_cep'];
    $endereco_estado = $get['endereco_estado'];
  }
}

if(stripos($_SERVER["HTTP_USER_AGENT"], 'Firefox') !== false) {$dataNasc = date("d/m/Y", strtotime($dataNasc));}
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
        <small>Editar Pacientes</small>
      </h1>
      <br>
      <div class="cadastro">

        <form method="post" action="editar.php">

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Nome Completo:*</span>
            <input required type="text" class="form-control" name="nomePaciente" aria-describedby="basic-addon1" value="<?php echo $nomePaciente; ?>"
              maxlength="150">
          </div>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Data de Nascimento:*</span>
            <input required type="date" class="form-control" name="dataNasc" aria-describedby="basic-addon1" max="9999-12-31" maxlength="10"
              value="<?php echo $dataNasc; ?>" OnKeyPress="formatar('##/##/####', this)">
          </div>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Telefone Fixo:</span>
            <input type="text" class="form-control" name="telFixo" aria-describedby="basic-addon1" placeholder="00 12345678" maxlength="11"
              OnKeyPress="formatar('## ########', this)" value="<?php echo $telFixo; ?>">
          </div>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Telefone Celular:*</span>
            <input required type="text" class="form-control" name="telCel" aria-describedby="basic-addon1" placeholder="00 012345678"
              maxlength="12" OnKeyPress="formatar('## #########', this)" value="<?php echo $telCel; ?>">
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Número da Identidade/RG:*</span>
                <input required type="text" class="form-control" name="RG" aria-describedby="basic-addon1" maxlength="20" value="<?php echo $RG; ?>">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Orgão Expedidor/UF:*</span>
                <input required type="text" class="form-control" name="RGUFEXP" aria-describedby="basic-addon1" maxlength="10" value="<?php echo $RGUFEXP; ?>">
              </div>
            </div>
          </div>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Email:</span>
            <input type="text" class="form-control" name="email" aria-describedby="basic-addon1" value="<?php echo $email; ?>" maxlength="100"
              pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="exemplo@exemplo.com">
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
                    <input type="text" class="form-control" name="endereco_logradouro" aria-describedby="basic-addon1" value="<?php echo $endereco_logradouro; ?>"
                      maxlength="150">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Número:</span>
                    <input type="text" class="form-control" name="endereco_numero" aria-describedby="basic-addon1" value="<?php echo $endereco_numero; ?>"
                      maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Complemento:</span>
                    <input type="text" class="form-control" name="endereco_complemento" aria-describedby="basic-addon1" value="<?php echo $endereco_complemento; ?>"
                      maxlength="20">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Bairro:</span>
                    <input type="text" class="form-control" name="endereco_bairro" aria-describedby="basic-addon1" value="<?php echo $endereco_bairro; ?>"
                      maxlength="100">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Cidade:</span>
                    <input type="text" class="form-control" name="endereco_cidade" aria-describedby="basic-addon1" value="<?php echo $endereco_cidade; ?>"
                      maxlength="100">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">CEP:</span>
                    <input type="text" class="form-control" name="endereco_cep" aria-describedby="basic-addon1" maxlength="8" value="<?php echo $endereco_cep; ?>"
                      onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                  </div>

                  <div class="form-group">
                    <select name="endereco_estado" class="form-control">
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

          <br>
          <br>

          <input hidden type="text" name="idPaciente" value="<?php echo $idPaciente; ?>">

          <center>
            <button type="submit" class="btn btn-raised btn-primary btn-lg">ATUALIZAR</button>
          </center>

        </form>

      </div>
    </div>
  </div>

</body>

</html>