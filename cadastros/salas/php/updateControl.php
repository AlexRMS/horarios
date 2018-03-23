<?php
  include_once('../../../lib/conexao.php');
  include_once('../../../dao/alterarDao.php');
  include_once('../../../dao/salaDao.php');
  include_once('../../../domain/sala.php');
  
  $conexao = new Conexao();
  $alterarDao = new AlterarDao($conexao);
  $salaDao = new SalaDao($conexao);
  $sala = new Sala();
  
  $sala->setId($_GET['id']);
  $sala->setNome($_POST['nome']);
  
  $result = $salaDao->update($sala);
  
  if($result === true) {
    $alterarDao->update();
    Header('location: ../update.php?r=1');
  } else if($result === false) {
    Header('location: ../update.php?id='.$id.'&r=2');
  } else {
    Header('location: ../update.php?id='.$id.'&r=2&erro=' . $result);
  }
?>