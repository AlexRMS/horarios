<?php
  include_once('../../../lib/conexao.php');
  include_once('../../../dao/alterarDao.php');
  include_once('../../../dao/professorDao.php');
  include_once('../../../domain/professor.php');
  
  $conexao = new Conexao();
  $alterarDao = new AlterarDao($conexao);
  $professorDao = new ProfessorDao($conexao);
  $professor = new Professor();
  
  $professor->setId($_GET['id']);
  $professor->setNome($_POST['nome']);
  
  $result = $professorDao->update($professor);
  
  if($result === true) {
    Header('location: ../update.php?r=1');
    $alterarDao->update();
  } else if($result === false) {
    Header('location: ../update.php?id='.$id.'&r=2');
  } else {
    Header('location: ../update.php?id='.$id.'&r=2&erro=' . $result);
  }
?>