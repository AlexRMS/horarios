<?php
  include_once('../../../lib/conexao.php');
  include_once('../../../dao/alterarDao.php');
  include_once('../../../dao/tipoDao.php');
  
  $conexao = new Conexao();
  $alterarDao = new AlterarDao($conexao);
  $tipoDao = new TipoDao($conexao);
  
  $id = $_GET['id'];
  
  $result = $tipoDao->exclude($id);
  
  if($result === true) {
    $alterarDao->update();
    Header('location: ../select.php');
  } else {
    Header('location: ../select.php?erro=' . $result);
  }
?>