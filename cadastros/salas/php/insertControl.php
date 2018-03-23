<?php
  include_once('../../../lib/conexao.php');
  include_once('../../../dao/salaDao.php');
  include_once('../../../domain/sala.php');
  
  $conexao = new Conexao();
  $salaDao = new SalaDao($conexao);
  $sala = new Sala();
  
  $sala->setNome($_POST['nome']);
  
  $result = $salaDao->insert($sala);
  
  if($result === true) {
    Header('location: ../insert.php?r=1');
  } else if($result === false) {
    Header('location: ../insert.php?r=2');
  } else {
    Header('location: ../insert.php?r=3&erro=' . $result);
  }
?>