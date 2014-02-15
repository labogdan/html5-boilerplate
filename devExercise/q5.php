<?php 

class TwoDArray {
	
	private $arr = array();
	
	public function readFileFromParam() {
		global $argv;
		$myArr = array();

		if (($file = fopen($argv[1], "r") or exit ("Sorry - file not found.")) != FALSE) {
			while (($data = fgetcsv($file,1000," ")) != FALSE) {
				$num = count($data);
				for ($c = 0; $c < $num; $c++) {
					echo $data[$c]." ";
				}
			}
			
		}	
		fclose($file);
		
	}
	
	public function printArray() {
		
/*		$myArray = array (
			array(1,2,3),
			array(4,5,6),
			array(7,8,9),
			array(10,11,12),
			array(13,14,15)
		);*/
		
		$myArray = $this->arr;
		
		$xLength = count($myArray);
		$yLength = max(array_map('count', $myArray));
		
		echo $xLength;
		
		for ($i = 0; $i < $xLength; $i++) {
			for ($j = 0; $j < $yLength; $j++) {
				echo $myArray[$i][$j]." ";
			}
		}
		
	}
	
}

$obj = new TwoDArray;

$obj->readFileFromParam();

//$obj->printArray();
	
?> 
 