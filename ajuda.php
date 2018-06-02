<?php
  session_start();

  if(empty($_SESSION["idUsuario"])){
    include("componentes/redirect.php");
  }

  require($_SESSION["installFolder"]."componentes/sessionbuster.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Ajuda - ConsuCloud</title>

  <?php include $_SESSION["installFolder"]."componentes/boot.php";?>
</head>

<body>
  
  <?php include $_SESSION["installFolder"]."componentes/barra.php"; ?>

  <div class="container">
    <div class="jumbotron">
      <h1>Ajuda</h1>
      <p>Tire aqui dúvidas sobre o sistema.</p>

      <br>

      <div class="panel-group" id="accordion">
        <div class="panel panel-default">

          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Permissões de Acesso ▾</a>
            </h4>
          </div>

          <div id="collapse1" class="panel-collapse collapse">
            <div class="panel-body">As permissões de acesso funcionam de maneira simples:
              <br>
              <br>
              <ul>
                <li>
                  <b>Secretaria:</b> Cadastra novos pacientes e gerencia consultas. Não pode acessar áreas avançadas ou áreas
                  médicas.</li>
                <br>
                <li>
                  <b>Médico:</b> Cadastra prontuários de pacientes ligados a ele por cadastro prévio na consulta e imprime
                  receitas, mas não acessa áreas avançadas.</li>
                <br>
                <li>
                  <b>Administração:</b> Tem acesso total ao sistema, com exceção a área restrita de prontuários (Área Médica).
                  Pode acessar áreas avançadas para configuração do sistema e cadastro de médicos e planos de saúde.</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Configurações do Sistema ▾</a>
            </h4>
          </div>

          <div id="collapse2" class="panel-collapse collapse">
            <div class="panel-body">
              As configurações do sistema, são compostas por opções simples como nome e endereço do consultório. Porém só podem ser acessadas
              pela administração, para maiores informações consulte o gerente do sistema ou do consultório.
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Dicas ▾</a>
            </h4>
          </div>

          <div id="collapse3" class="panel-collapse collapse">
            <div class="panel-body">
              <ul>
                <li>
                  <b>Selecionando Pacientes:</b> Nesta hora você tem duas opcões, RG ou Nome Completo, você pode usar ambas
                  as oções ou apenas uma delas. Recomendados o uso de apenas uma para agilizar o processo de busca.</li>
                <br>
                <li>
                  <b>Consultas Abandonadas:</b> Ao final do dia, é recomendado que sejam removidas do sistema consultas as
                  quais os pacientes não tenham comparecido, para que o histórico de consultas do sistema mantenha-se limpo
                  e preciso.</li>
                <br>
                <li>
                  <b>Salvar Prontuário/Relatório em PDF:</b> O navegador de internet recomendado para o melhor funcionamento
                  do ConsuCloud é o Google Chrome. Embutido nele existe uma "impressora virtual" que salva o que você quer
                  imprimir como PDF. Para usar esta função, é bem simples. Quando a janela de impressão abrir, na hora
                  de escolher a sua impressora, escolha "Salvar como PDF" e logo após abrirá uma janela pedindo para escolher
                  onde deseja salvar. Pronto! Você tem agora seu PDF em mãos!</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Confirmado/Desconfirmando Consultas ▾</a>
            </h4>
          </div>
          <div id="collapse4" class="panel-collapse collapse">
            <div class="panel-body">
              As confirmações e desconfirmações de consultas, envolvem o uso dos ícones
              <span class="glyphicon glyphicon-thumbs-up"
                aria-hidden="true"></span> e
              <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>.
              <br>
              <br> Quando o cliente chegar ao consultório, sempre clique no ícone
              <span class="glyphicon glyphicon-thumbs-up"
                aria-hidden="true"></span>, para confirmar a consulta, para que ela seja exibida corretamente no relatório e para avisar ao
              médico que o paciênte está presente no consultório.
              <br>
              <br> Consultas com
              <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
              não serão exibidas no relatório, mas se manterão arquivadas no sistema. Uma consulta por padrão, é marcada com status
              <span
                class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span> (não confirmada).
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>

</body>

</html>