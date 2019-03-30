<?php
  include("installdir.php");
  
  if(empty($installDir)){
      $installDir = "/";
      $installAddr = "http://".$_SERVER['HTTP_HOST'].$installDir;
    }else{
      $installAddr = "http://".$_SERVER['HTTP_HOST'].$installDir;
    }
  
  echo "<script>top.window.location = '".$installAddr."index.php?erro=ERROFATAL'</script>";
  die();
?>