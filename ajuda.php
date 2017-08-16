<?php
  session_start();

  if(empty($_SESSION)){
    header("Location: ../index.php?erro=ERROFATAL");
    exit();
  }
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Ajuda - ConsuCloud</title>

   <?php include "componentes/boot.php";?>
</head>

<body>

<?php include "componentes/barra.php"; ?>

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
              <div class="panel-body">As permissões de acesso funcionam de maneira simples: <br>
                <ul>
                  <li><b>Secretaria:</b> Cadastra novos pacientes e gerencia consultas. Não pode acessar áreas avançadas ou áreas médicas.</li>
                  <li><b>Médico:</b> Cadastra prontuários de pacientes ligados a ele por cadastro prévio na consulta e imprime receitas, mas não acessa áreas avançadas.</li>
                  <li><b>Administração:</b> Tem acesso total ao sistema, com exceção a área restrita de prontuários (Área Médica). Pode acessar áreas avançadas para configuração do sistema e cadastro de médicos e planos de saúde.</li>
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
                As configurações do sistema, são compostas por opções simples como nome e endereço do consultório. Porém só podem ser acessadas pela diretoria, para maiores informações consulte o gerente do sistema ou do consultório.
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
                  <li><b>Selecionando Pacientes:</b> Na hora de escolher o paciente, no menu "dropdown", ao invés de procurar na lista, simplesmente digite o nome do mesmo após clicar na lista e ele será buscado automáticamente.</li>
                  <li><b>Consultas Abandonadas:</b> Ao final do dia, é recomendado que sejam removidas do sistema consultas as quais os pacientes não tenham comparecido, para que o histórico de consultas do sistema mantenha-se limpo e preciso.</li>
				  <li><b>Salvar Prontuário/Relatório em PDF:</b> O navegador de internet recomendado para o melhor funcionamento do ConsuCloud é o Google Chrome. Embutido nele existe uma "impressora virtual" que salva o que você quer imprimir como PDF.
						Para usar isso é bem simples. Quando a janela de impressão abrir, na hora de escolher a sua impressora, escolha "Salvar como PDF" e logo após abrirá uma janela pedindo para escolher onde deseja salvar. Pronto! Você tem agora seu PDF em mãos!</li>
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
                As confirmações e desconfirmações de consultas, envolvem o uso dos ícones <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> e <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>, quando o cliente chegar
                no consultório, sempre clique no ícone <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>, para confirmar a consulta e para que ela seja exibida corretamente no relatório. Consultas com <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
                não serão exibidas no relatório, mas se manterão arquivadas no sistema. Uma consulta por padrão, é marcada com status 'não confirmada' <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>.
              </div>
            </div>
          </div>

        </div>

    </div>
  </div>

</body>

</html>
