<?php
  include_once('../../../lib/conexao.php');
  include_once('../../../dao/professorDao.php');
  include_once('../../../domain/professor.php');
  
  $conexao = new Conexao();
  $professorDao = new ProfessorDao($conexao);
  $professor = new Professor();
  
  $professor->setNome($_POST['nome']);
  
  
  $result = $professorDao->insert($professor);
  
  if($result === true) {
    Header('location: ../insert.php?r=1');
  } else if($result === false) {
    Header('location: ../insert.php?r=2');
  } else {
    Header('location: ../insert.php?r=3&erro=' . $result);
  }
?>