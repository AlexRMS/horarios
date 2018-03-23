<?php
  include_once('../../../lib/conexao.php');
  include_once('../../../dao/turmaDao.php');
  include_once('../../../domain/turma.php');
  
  $conexao = new Conexao();
  $turmaDao = new TurmaDao($conexao);
  $turma = new Turma();
  
  $turma->setNome($_POST['nome']);
  $turma->setTurno($_POST['turno']);
  
  $result = $turmaDao->insert($turma);
  
  if($result === true) {
    Header('location: ../insert.php?r=1');
  } else if($result === false) {
    Header('location: ../insert.php?r=2');
  } else {
    Header('location: ../insert.php?r=3&erro=' . $result);
  }
?>