<?php
  include_once('../../../lib/conexao.php');
  include_once('../../../dao/alterarDao.php');
  include_once('../../../dao/turmaDao.php');
  include_once('../../../domain/turma.php');
  
  $conexao = new Conexao();
  $alterarDao = new AlterarDao($conexao);
  $turmaDao = new TurmaDao($conexao);
  $turma = new Turma();
  
  $turma->setNome($_GET['id']);
  $turma->setNome($_POST['nome']);
  $turma->setTurno($_POST['turno']);
    
  $result = $turmaDao->update($turma);
  
  if($result === true) {
    $alterarDao->update();
    Header('location: ../update.php?r=1');
  } else if($result === false) {
    Header('location: ../update.php?id='.$id.'&r=2');
  } else {
    Header('location: ../update.php?id='.$id.'&r=2&erro=' . $result);
  }
?>