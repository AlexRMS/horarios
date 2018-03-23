<?php
	$turno = null;
  if($_GET) $turno = $_GET['turno'];
  
  function json_turma($turno){
    include_once('../../../lib/conexao.php');
    include_once('../../../dao/turmaDao.php');
    
    $conexao = new Conexao();
    $turmaDao = new TurmaDao($conexao);
    
    echo json_encode($turmaDao->selectByTurno($turno));
  }
  
  json_turma($turno);
?>