<?php
  include_once("lib/session.php");
  include_once("lib/head.php");
  
  include_once("lib/conexao.php");
  
  include_once("dao/alterarDao.php");
  include_once("dao/horarioDao.php");
  include_once("dao/professorDao.php");
  include_once("dao/registroDao.php");
  include_once("dao/salaDao.php");
  include_once("dao/tipoDao.php");
  include_once("dao/turmaDao.php");
  
  $conexao = new Conexao();
  
  $alterarDao = new AlterarDao($conexao);
  
  $atual = $alterarDao->select();
  echo '<script>var atual = null;</script>';
  echo '<script>atual = "'.$atual["alteracao"].'";</script>';

  $horarioDao = new HorarioDao($conexao);
  $professorDao = new ProfessorDao($conexao);
  $registroDao = new RegistroDao($conexao);
  $salaDao = new SalaDao($conexao);
  $tipoDao = new TipoDao($conexao);
  $turmaDao = new TurmaDao($conexao);
  
  date_default_timezone_set( 'America/Sao_Paulo' );
  
  $H_to_MS = "3600000";
  $M_to_MS = "60000";
  $S_to_MS = "1000";
  
  $h = date('H');
  $m = date('i');
  $s = date('s');
  
  $ms = ($h * $H_to_MS)+($m * $M_to_MS)+($s * $S_to_MS);
  
  $data = date('Y-m-d');
  
  $mat = date('00:00');
  $vesp = date('12:30');
  $not = date('18:00');
  $date = date('H:i');
  
  if($date >= $mat && $date < $vesp){
    $turno = "Matutino";
  }else if ($date >= $vesp && $date < $not) {
    $turno = "Vespertino";
  }else if ($date >= $not) {
    $turno = "Noturno";
  }
  
  $registros = $registroDao->search($data);
  
  $horarios = null;
  $i = 0;
  if(is_array($registros)) {
    foreach($registros as $registro) {
      $horario = $horarioDao->searchByIdAndTurno($registro['idHorario'], $turno);
      if($horario != null && $horario != false) {
        $horarios[$i] = $horario;
        $i++;
      }
    }
  }

  if(is_array($horarios)) {
    $idTipos;
    $i = 0;
    foreach($horarios as $horario) {
      $idTipos[$i] = $horario['idTipo'];
      $i++;
    }
    
    $tipos = null;
    $i = 0;
    foreach($idTipos as $id) {
      $tipos[$i] = $tipoDao->searchById($id);
      $i++;
    }
    $tipos = array_unique($tipos);
    
    switch(count($tipos)) {
      case 1:
        $classeBox = " box-full";
        $classeCol = "col-xs-12 col-md-12";
        $limit = 12;
        break;
      case 2:
        $classeBox = " box-full";
        $classeCol = "col-xs-12 col-md-6";
        $limit = 12;
        break;
      case 3:
        $classeBox = " box-middle";
        $classeCol = "col-xs-12 col-md-6";
        $limit = 5;
        break;
      case 4:
        $classeBox = " box-middle";
        $classeCol = "col-xs-12 col-md-6";
        $limit = 5;
        break;
    }
  }
?>

<!DOCTYPE html>

<head>
  <title>Horários Senai-SJ</title>
  <?php ativarHead(); ?>
  <link rel="stylesheet" href="css/horarios.css">
  <link rel="stylesheet" href="css/slick.css">
  <link rel="stylesheet" href="css/slick-theme.css">
  <script src="js/slick.js"></script>
  
  <style>
    .slick-arrow {
      display: none !important;
    }
  </style>
  
  <script>
    if (screen.width < 720) {
      window.location.href = "horariosMobile.php";
    }
  </script>
  
  <script>
    function atualizar(ms){
      var matutino = 86400000;
      var vespertino = 45000000;
      var noturno = 64800000;
      var troca;
      
      if(ms < vespertino) {
        troca = vespertino - ms;
      } else if(ms < noturno) {
        troca = noturno - ms;
      } else {
        troca = matutino - ms;
      }
      window.setInterval(function(){window.location.reload();}, troca);
    }
  </script>
</head>

<body>
  <div class="container-fluid container-horarios">
    <div class="row">
    <?php
      if(is_array($horarios)) {
        $i = 0;
        $slick = 0;
        foreach ($tipos as $tipo) {
          $slick++;
          if(count($tipos) == 3) {
            $i++;
            if($i == 3) {
              $classeCol = " col-md-12";
            }
          }
          echo '
            <div class="' . $classeCol . '">
              <div class="box box-info' . $classeBox . '">
                <div class="box-header with-border">
                  <h3 class="box-title"><span class="label label-primary">' . $tipo . '</span></h3>
                </div>
                <div id="slick'.$slick.'">
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table no-margin">
                        <thead>
                          <tr>
                            <th class="col-md-5"><span class="label label-info">Turma</span></th>
                            <th class="col-md-3"><span class="label label-info">Professor</span></th>
                            <th class="col-md-4"><span class="label label-info">Sala</span></th>
                          </tr>
                        </thead>
                        <tbody>
                          ';
                          $contador = 0;
                          foreach($horarios as $horario) {
                            if($tipoDao->searchById($horario['idTipo']) == $tipo) {
                              $contador++;
                              $turma = $turmaDao->searchById($horario['idTurma']);
                              $prof = $professorDao->searchById($horario['idProfessor']);
                              $sala = $salaDao->searchById($horario['idSala']);
                              echo '<tr role="row">';
                              echo '  <td>'. $turma .'</td>';
                              echo '  <td>'. $prof .'</td>';
                              echo '  <td>'. $sala .'</td>';
                              echo '</tr>';
                            }
                            
                            if($contador == $limit) {
                              echo '
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="box-body">
                      <div class="table-responsive">
                        <table class="table no-margin">
                          <thead>
                            <tr>
                              <th class="col-md-5"><span class="label label-info">Turma</span></th>
                              <th class="col-md-3"><span class="label label-info">Professor</span></th>
                              <th class="col-md-4"><span class="label label-info">Sala</span></th>
                            </tr>
                          </thead>
                          <tbody>';
                              $contador = 0;
                            }
                          }
                          echo '
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <script>
            $("#slick'.$slick.'").slick({
              dots: false,
              infinite: true,
              slidesToShow: 1,
              slidesToScroll: 1,
              autoplay: true,
              autoplaySpeed: 10000,
            });
            </script>
          ';
        }
      }
      if(!is_array($horarios)){
        echo '
          <div class="col-md-12">
            <div class="box box-info box-full">
              <div class="box-header" style="text-align: center;">
                <h1 class="box-title label label-warning" style="margin-top: 40vh;">Sem horários cadastrados!</h1>
              </div>
            </div>
          </div>
        ';
      }
    ?>
    </div>
  </div>
</body>
</html>
<?php echo '<script>atualizar('.$ms.');</script>';?>

<script>
  
  var atualizado = atual;
  var source = new EventSource("sse/sseControl.php");
  source.onmessage = function(event){
    atualizado = event.data;
    if(atualizado != atual) {
      //window.location.reload();
    }
  }

</script>