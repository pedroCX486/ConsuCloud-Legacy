<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Material Design -->
<link rel="stylesheet" type="text/css" href="../componentes/materialdesign/bootstrap-material-design.min.css" />
<link rel="stylesheet" type="text/css" href="../componentes/materialdesign/ripples.min.css" />
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons" />

<!-- Carregando o Favicon -->
<link rel="icon" href="/assets/favicon.ico" type="image/x-icon" />

<!-- Carregando a Folha de Estilos -->
<link rel="stylesheet" href="/componentes/estilos.css">

<!-- Gambiarra pra Evitar Usuários de Fazerem Merda -->
<?php
if(basename($_SERVER['PHP_SELF']) != "app.php"){
  echo "<script>
          $(document).ready(function()
          {
              $('a').each(function() {
                  var href= $(this).attr('href');
                  $(this).attr('href','javascript:void(0);');
                  $(this).attr('jshref',href);
              });
              $('a').bind('click', function(e) 
              {
                  e.stopImmediatePropagation();           
                  e.preventDefault();
                  e.stopPropagation();
                  var href= $(this).attr('jshref');
                  if ( !e.metaKey && e.ctrlKey )
                      e.metaKey = e.ctrlKey;
                  if(!e.metaKey)
                  {
                      location.href= href;
                  }
                  return false;
              })
          });
        </script>";
}
?>