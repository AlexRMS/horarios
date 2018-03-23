<?php
  header('Content-Type: text/event-stream');
  header('Cache-Control: no-cache');
  
  include_once('../lib/conexao.php');
  include_once('../dao/alterarDao.php');
  
  $conexao = new Conexao();
  $alterarDao = new AlterarDao($conexao);
  
  $resposta = $alterarDao->select();
  echo $resposta['alteracao'];
  if($err == 0){
    echo "data:Valor:\n";
    echo "data:".$resposta['alteracao']."\n\n";
  }else{
    echo "data: erro = {".$err."}\n\n";
  }
  
  flush();
?>