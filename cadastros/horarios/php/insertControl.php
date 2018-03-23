<?php
  include_once('../../../lib/conexao.php');
  include_once('../../../dao/alterarDao.php');
  include_once('../../../dao/horarioDao.php');
  include_once('../../../dao/registroDao.php');
  include_once('../../../domain/horario.php');
  
  $conexao = new Conexao();
  
  $alterarDao = new AlterarDao($conexao);
  $horarioDao = new HorarioDao($conexao);
  $registroDao = new RegistroDao($conexao);
  
  $horario = new Horario();
  
  $horario->setTurno($_POST['turno']);
  $horario->setTurma($_POST['turma']);
  $horario->setProfessor($_POST['professor']);
  $horario->setSala($_POST['sala']);
  $horario->setTipo($_POST['tipo']);
  $datas = $_POST['datas'];
  
  $dates = split(",", $datas);
  
  $result = $horarioDao->insert($horario);
  
  if($result === true) {
    $horarios = $horarioDao->searchByAll($horario);
    
    if(is_array($horarios)) {
      $final = $registroDao->insert($horarios['id'], $dates);
    } else if($horarios != false) {
      Header('location: ../insert.php?r=3&erro=' . $horarios);
    }
  }
  
  if($result === true && $final === true) {
    $alterarDao->update();
    Header('location: ../insert.php?r=1');
  } else if($result === false || $final === false) {
    Header('location: ../insert.php?r=2');
  } else {
    Header('location: ../insert.php?r=3&erro=' . $result . '<br>Erro 2: ' . $final);
  }
?>