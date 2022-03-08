<?php
require_once("../global/conexao.php");

$ids = file("file.txt");
$ids = implode(',', $ids);
$query = "SELECT * FROM carros.carros WHERE id IN ($ids)";
$result = pg_query($conn, $query);

if(!$result) die("Erro ao executar query!");
echo "COMEÇO<br/><br/>";

while($row = pg_fetch_assoc($result)){
	echo "=========================<br/>";
	echo "ID: ".$row["id"]."<br/>";
	echo "MODELO: ".$row["modelo"]."<br/>";
	echo "COR: ".$row["cor"]."<br/>";
	echo "=========================<br/><br/>";
}

echo "FIM";

?>