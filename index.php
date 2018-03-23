<?php
  include_once("lib/session.php");
  include_once("lib/head.php");
  include_once("lib/navbar.php");
?>

<!DOCTYPE html>

<head>
  <?php ativarHead(); ?>
</head>

<body>
  <div class="container">
    <?php navbar("home",$logado); ?>
    
    <div class="row gutter">
        <div class="box box-info">
        <div class="box-header">
          <center><h1 class="box-title"><span class="label label-primary">Bem vindo ao Quadro de Horários!</span></h1></center>
        </div>
        <div class="box-body"></div>
      </div>
    </div>
  </div>
</body>

</html>