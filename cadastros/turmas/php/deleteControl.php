<?php
  include_once('../../../lib/conexao.php');
  include_once('../../../dao/alterarDao.php');
  include_once('../../../dao/turmaDao.php');
  
  $conexao = new Conexao();
  $alterarDao = new AlterarDao($conexao);
  $turmaDao = new TurmaDao($conexao);
  
  $id = $_GET['id'];
  
  $result = $turmaDao->exclude($id);
  
  if($result === true) {
    $alterarDao->update();
    Header('location: ../select.php');
  } else {
    Header('location: ../select.php?erro=' . $result);
  }
?>