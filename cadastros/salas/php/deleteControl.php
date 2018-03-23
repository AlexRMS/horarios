<?php
  include_once('../../../lib/conexao.php');
  include_once('../../../dao/salaDao.php');
  include_once('../../../dao/alterarDao.php');
  
  $conexao = new Conexao();
  $salaDao = new SalaDao($conexao);
  $alterarDao = new AlterarDao($conexao);
  
  $id = $_GET['id'];
  
  $result = $salaDao->exclude($id);
  
  if($result === true) {
    $alterarDao->update();
    Header('location: ../select.php');
  } else {
    Header('location: ../select.php?erro=' . $result);
  }
?>