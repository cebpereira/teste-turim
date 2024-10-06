<?php

$host = "mysql_db";
$user = "root";
$password = "root";
$db = "mysql-db";

$conexao = mysqli_connect($host, $user, $password, $db);

if (!$conexao) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}
