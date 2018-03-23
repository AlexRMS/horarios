<?php
  include_once('../../../lib/conexao.php');
  include_once('../../../dao/alterarDao.php');
  include_once('../../../dao/horarioDao.php');
  include_once('../../../dao/registroDao.php');
  
  $conexao = new Conexao();
  
  $alterarDao = new AlterarDao($conexao);
  $horarioDao = new HorarioDao($conexao);
  $registroDao = new RegistroDao($conexao);
  
  $id = $_GET['id'];
  
  $result1 = $registroDao->exclude($id); 
  $result = $horarioDao->exclude($id);
  
  if($result === true && $result1 === true) {
    $alterarDao->update();
    Header('location: ../select.php');
  } else {
    Header('location: ../select.php?erro=' . $result . '<br>Erro 2: ' . $result1);
  }
?>