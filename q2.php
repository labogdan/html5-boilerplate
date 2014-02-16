<?php 

/*
 * This class holds the array that was read from file, supplied as a command
 * line parameter, and prints it out.
 * 
 */

class TwoDArray {
	
    const DELIMITER = " ";  //declaring as constant, so it can be easily modified.
    
	private $arr = array();

    /*
     * This method reads the file as a command line parameter.  It uses
     * 
     */
	
	public function readFileFromParam() {
		global $argv;
		$myArr = array();

		if (($file = fopen($argv[1], "r") or exit ("Sorry - file not found.")) != FALSE) {
			while (($data = fgetcsv($file,1000,self::DELIMITER)) != FALSE) { //TODO: need to make sure this doesn't stop at some arbitrary value
				$num = count($data);
				for ($c = 0; $c < $num; $c++) {
					echo $data[$c]." ";
				}
			}
			
		}	
		fclose($file);
		
	}
	
	public function printArray() {
		
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
	
?> 
 