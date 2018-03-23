<?php
  include_once("lib/session.php");
  if(!$logado) Header("Location: ../master/");
  include_once("lib/navbar.php");
  include_once("lib/head.php");
?>

<!DOCTYPE html>

<head>
  <?php ativarHead(); ?>
</head>

<body style="overflow-y: hidden;">
  <div class="container">
    <?php navbar("cadastros",$logado); ?>
    
    <div class="row embed-responsive embed-responsive-16by9">
      <iframe class="embed-responsive-item" id="iframeCadastroProfessores" name="iframeCadastroProfessores" src="/master/cadastros/professores/select.php"></iframe>
    </div>
  </div>
</body>

</html>