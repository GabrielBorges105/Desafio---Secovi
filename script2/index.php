<?php
$rows = file("file.txt");
$word = strtolower("ESPECIAL");

foreach ($rows as $row) {
	$rowLower = strtolower($row);
	if(strpos($rowLower, $word) !== false) {
		echo $row."<br/>";
	}
}
?>