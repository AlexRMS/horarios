<?php
include_once('../lib/conexao.php');
include_once('../dao/alterarDao.php');

$conexao = new Conexao();

$alterarDao = new AlterarDao($conexao);

$err;

if($_POST) {
    $alterarDao->update();
}
?>
<h1>Update tela</h1>
<form method="POST">
    <input type="hidden" name="alteracao" value="a">
    <input type="submit" value="Submit">
</form>