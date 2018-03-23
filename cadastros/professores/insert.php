<?php
  include_once('../../lib/head.php');
  
  if(ISSET($_GET['r'])) {
    $r = $_GET['r'];
    if(ISSET($_GET['erro'])) $erro = $_GET['erro'];
    
    if($r == 1) {
      Header('location: select.php');
    } else if($r == 2) {
      echo '<script>alert("Professor já cadastrado!")</script>';
    } else if($r == 3) {
      echo '<script>alert("Erro: '.$erro.'")</script>';
    } 
  }
?>

<!DOCTYPE html>

<head>
  <?php ativarHead(); ?>
</head>

<body>
  <div class="container_fluid container-iframe">
    <div class="row">
      <div class="box box-info box-iframe">
        <div class="box-header with-border">
          <h3 class="box-title"><span class="label label-info">Cadastro de Professores</span></h3>
        </div>
        <form class="form-horizontal" action="/master/cadastros/professores/php/insertControl.php" method="POST">
          <div class="box-body">
            <div class="form-group">
              <label for="inputNome" class="col-sm-2 control-label">Nome</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputNome" name="nome" placeholder="Nome">
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="button" onclick="window.location='/master/cadastros/professores/select.php';" class="btn btn-danger">Cancel</button>
            <button type="submit" class="btn btn-info pull-right">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>document.getElementById('inputNome').focus();</script>
</body>

</html>