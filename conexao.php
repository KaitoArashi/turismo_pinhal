<?php
$bd_usuario     = "qrpinhal";
$bd_senha       = "@Dudu_130513";
$bd_servidor    = "mysql-qrpinhal.alwaysdata.net";
$bd_database    = "qrpinhal_turismo";
$bd_porta       = "3306";

$conexao = mysqli_connect($bd_servidor, $bd_usuario, $bd_senha, $bd_database, $bd_porta);

if (!$conexao) {
  die("Conexão Falhou: " . mysqli_connect_error());
}
