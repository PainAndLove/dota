<?php
	$fh=file_get_contents("./data/heroes.json");
	print_r(json_decode($fh,true)) ;
?>