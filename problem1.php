<?php 
// 	echo '<p>Hello World</p>';
//	fwrite(STDOUT, 'adsf');

class MyClass {
	
	public $prop1 = "some text";
	
	public function setProperty($newVal) {
		$this->prop1 = $newVal;
	}
	
	public function getProperty() {
		return $this->prop1;
	}
	
}

$obj = new MyClass;

echo $obj->prop1;





class TwoDArray {
	
	public function readFile() {
		global $argv;
		var_dump($argv);
		echo $argv[0];
	}
	
}
var_dump($argv);

$obj = new TwoDArray;

$obj->readFile();

	
 ?> 
 