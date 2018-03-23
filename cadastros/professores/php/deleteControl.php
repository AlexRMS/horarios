<?php
  include_once('../../../lib/conexao.php');
  include_once('../../../dao/alterarDao.php');
  include_once('../../../dao/professorDao.php');
  
  $conexao = new Conexao();
  $alterarDao = new AlterarDao($conexao);
  $professorDao = new ProfessorDao($conexao);
  
  $id = $_GET['id'];
  
  $result = $professorDao->exclude($id);
  
  if($result === true) {
    $alterarDao->update();
    Header('location: ../select.php');
  } else {
    Header('location: ../select.php?erro=' . $result);
  }
?>