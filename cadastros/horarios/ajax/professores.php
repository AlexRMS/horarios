<?php
  function json_professor(){
    include_once('../../../lib/conexao.php');
    include_once('../../../dao/professorDao.php');
    
    $conexao = new Conexao();
    $professorDao = new ProfessorDao($conexao);
    
    echo json_encode($professorDao->select());
  }
  
  json_professor();
?>