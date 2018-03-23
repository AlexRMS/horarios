<?php
  include_once('../../../lib/conexao.php');
  include_once('../../../dao/alterarDao.php');
  include_once('../../../dao/tipoDao.php');
  include_once('../../../domain/tipo.php');
  
  $conexao = new Conexao();
  $alterarDao = new AlterarDao($conexao);
  $tipoDao = new TipoDao($conexao);
  $tipo = new Tipo();
  
  $tipo->setId($_GET['id']);
  $tipo->setNome($_POST['nome']);
  
  $result = $tipoDao->update($tipo);
  
  if($result === true) {
    $alterarDao->update();
    Header('location: ../update.php?r=1');
  } else if($result === false) {
    Header('location: ../update.php?id='.$id.'&r=2');
  } else {
    Header('location: ../update.php?id='.$id.'&r=2&erro=' . $result);
  }
?>