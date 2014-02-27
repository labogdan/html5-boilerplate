<?php 
	include 'beers.php';
	
	$beer = $_REQUEST['id'];
	
	for ($i = 0; $i < count($arr); $i++) {
		foreach ($arr[$i] as $val) {
			if ($beer == $val) {
				echo json_encode($arr[$i]);
			}
		}
	}
?> 
