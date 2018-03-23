<?php
  include_once('../../../lib/conexao.php');
  include_once('../../../dao/tipoDao.php');
  include_once('../../../domain/tipo.php');
  
  $conexao = new Conexao();
  $tipoDao = new TipoDao($conexao);
  $tipo = new Tipo();
  
  $tipo->setNome($_POST['nome']);
  
  $result = $tipoDao->insert($tipo);
  
  if($result === true) {
    Header('location: ../insert.php?r=1');
  } else if($result === false) {
    Header('location: ../insert.php?r=2');
  } else {
    Header('location: ../insert.php?r=3&erro=' . $result);
  }
?>