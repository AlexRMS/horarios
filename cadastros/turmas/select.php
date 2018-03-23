<?php
  include_once('../../lib/head.php');
  include_once('../../lib/conexao.php');
  include_once('../../dao/turmaDao.php');
  include_once('../../domain/turma.php');
  
  $conexao = new Conexao();
  $turmaDao = new TurmaDao($conexao);
  $turma = new Turma();
  
  if(ISSET($_GET['erro'])) {
    echo '<script>alert("Erro: '.$_GET["erro"].'");</script>';
  }
  
  if(ISSET($_POST['nome'])) {
    $nome = $_POST['nome'];
    if($nome == "") {
      $result = $turmaDao->select();
    } else {
      $turma->setNome($nome);
      $result = $turmaDao->search($turma);
    }
  } else {
    $result = $turmaDao->select();
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
      <div class="box box-info box-iframe">
        <div class="box-header with-border">
          <form class="form-horizontal" action="/master/cadastros/turmas/select.php" method="POST">
            <div class="col-md-2 col-xs-3"><h3 class="box-title"><button type="button" onclick="window.location='/master/cadastros/turmas/insert.php';" class="btn btn-info">Cadastrar Turma</button></h3></div>
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
                      <th class="col-md-5 col-xs-4">Nome</th>
                      <th class="col-md-5 col-xs-4">Turno</th>
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
                          echo '  <td>'.$result['turno'].'</td>';
                          echo '  <td><center><a href="/master/cadastros/turmas/update.php?id='.$result['id'].'" class="btn btn-warning">Editar</a></center></td>';
                          echo '  <td><center><a href="/master/cadastros/turmas/php/deleteControl.php?id='.$result['id'].'" class="btn btn-danger">Apagar</a></center></td>';
                          echo '</tr>';
                        } else {
                          foreach($result as $row) {
                            echo '<tr role="row">';
                            echo '  <td>'.$row['nome'].'</td>';
                            echo '  <td>'.$row['turno'].'</td>';
                            echo '  <td><center><a href="/master/cadastros/turmas/update.php?id='.$row['id'].'" class="btn btn-warning">Editar</a></center></td>';
                            echo '  <td><center><a href="/master/cadastros/turmas/php/deleteControl.php?id='.$row['id'].'" class="btn btn-danger">Apagar</a></center></td>';
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