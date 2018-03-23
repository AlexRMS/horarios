<?php
  include_once('../../lib/head.php');
  include_once('../../lib/conexao.php');
  include_once('../../dao/tipoDao.php');
  include_once('../../domain/tipo.php');
  
  $conexao = new Conexao();
  $tipoDao = new TipoDao($conexao);
  $tipo = new Tipo();
  
  if(ISSET($_GET['erro'])) {
    echo '<script>alert("Erro: '.$_GET["erro"].'");</script>';
  }
  
  if(ISSET($_POST['nome'])) {
    $nome = $_POST['nome'];
    if($nome == "") {
      $result = $tipoDao->select();
    } else {
      $tipo->setNome($nome);
      $result = $tipoDao->search($tipo);
    }
  } else {
    $result = $tipoDao->select();
  }
  
  $unico = null;
  if(ISSET($result['id'])) {
    $unico = true;
  }
  
  if(!is_array($result)) {
    if($result != false) {
      $erro = true;
    }
  } else {
    $erro = false;
  }
?>

<!DOCTYPE html>

<head>
  <?php ativarHead(); ?>
</head>

<body>
  <div class="container_fluid container-iframe">
    <div class="row">
      <div class="box box-info box-full">
        <div class="box-header with-border">
          <form class="form-horizontal" action="/master/cadastros/tipos/select.php" method="POST">
            <div class="col-md-2 col-xs-3"><h3 class="box-title"><button type="button" onclick="window.location='/master/cadastros/tipos/insert.php';" class="btn btn-info">Cadastrar Tipo</button></h3></div>
            <div class="col-md-10 col-xs-9 input-group">
              <input class="form-control" name="nome" type="text" placeholder="Pesquisar">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-success">Buscar</button>
              </span>
            </div>
          </form>
        </div>
        <div class="box-body">
          <div class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
              <div class="col-sm-12" style="height: 70vh; overflow-y: scroll;">
                <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                  <thead>
                    <tr role="row">
                      <th class="col-md-10 col-xs-8">Nome</th>
                      <th class="col-md-1 col-xs-2"></th>
                      <th class="col-md-1 col-xs-2"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      if($result != false && $erro == false) {
                        if($unico) {
                          echo '<tr role="row">';
                          echo '  <td>'.$result['nome'].'</td>';
                          echo '  <td><center><a href="/master/cadastros/tipos/update.php?id='.$result['id'].'" class="btn btn-warning">Editar</a></center></td>';
                          echo '  <td><center><a href="/master/cadastros/tipos/php/deleteControl.php?id='.$result['id'].'" class="btn btn-danger">Apagar</a></center></td>';
                          echo '</tr>';
                        } else {
                          foreach($result as $row) {
                            echo '<tr role="row">';
                            echo '  <td>'.$row['nome'].'</td>';
                            echo '  <td><center><a href="/master/cadastros/tipos/update.php?id='.$row['id'].'" class="btn btn-warning">Editar</a></center></td>';
                            echo '  <td><center><a href="/master/cadastros/tipos/php/deleteControl.php?id='.$row['id'].'" class="btn btn-danger">Apagar</a></center></td>';
                            echo '</tr>';
                          }
                        }
                      } else if($result != false) {
                        echo '<script>alert("Erro: "'.$result.')</script>';
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>