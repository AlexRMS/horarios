<?php
  function json_sala(){
    include_once('../../../lib/conexao.php');
    include_once('../../../dao/salaDao.php');
    
    $conexao = new Conexao();
    $salaDao = new salaDao($conexao);
    
    echo json_encode($salaDao->select());
  }
  
  json_sala();
?>