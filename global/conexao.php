<?php 

$server = "localhost";
$user = "postgres";
$password = "123456";
$db = "teste_secovi";
$port = 5432;
$db_connect = "host=$server port=$port dbname=$db user=$user password=$password";
$conn = pg_connect($db_connect) or die ("Erro ao tentar conectar");

?>