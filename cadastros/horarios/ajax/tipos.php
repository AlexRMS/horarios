<?php
  function json_tipo(){
    include_once('../../../lib/conexao.php');
    include_once('../../../dao/tipoDao.php');
    
    $conexao = new Conexao();
    $tipoDao = new TipoDao($conexao);
    
    echo json_encode($tipoDao->select());
  }
  
  json_tipo();
?>