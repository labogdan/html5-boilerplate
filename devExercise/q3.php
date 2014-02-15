<?php 

class Node {
	
	public $counter = 0;
	
	public $id;
	public $path;
	public $active = TRUE;
	
	function Node($destination, $id) {
		echo $this->id = $id." ";
		echo $this->path = $destination." ";
		echo $this->active = TRUE."\n";
		
	}
	
}

class NewNode extends Node {
	public $count = 0;
	
	function NewNode($howMany) {
		
		$nodeArr = array();
		
		for ($i = 0; $i < $howMany; $i++) {
			$nodeArr[$i] = new Node(2,$this->count++);
		}
/*		$n1 = new Node(2,$this->count++);
		$n2 = new Node(3,$this->count++);
		$n3 = new Node(4,$this->count++);
		$n4 = new Node(5,$this->count++);
		$n5 = new Node(6,$this->count++);
		$n6 = new Node(-1,$this->count++);
		$n7 = new Node(0,$this->count++);*/
	}	
}

//$node1 = new Node(2);
//$node2 = new Node(3);

$node1 = new NewNode(7);

?> 
 