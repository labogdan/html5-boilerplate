<?php 

class Node {
	
	public $id;
	public $path;
	public $active = TRUE;
	
	function Node($destination, $id) {
		$this->id = $id;
		$this->path = $destination;
		$this->active = TRUE;
		
	}
	
}

class NewNode extends Node {

	private $length = 0;
	private $count = -1;
	private $nodeArr = array();
	private $numCycles = 0;
		
	function NewNode($howMany) {
		global $argv;
		$i = 0;
		
		if (($file = fopen($argv[1], "r") or exit ("Sorry - file not found.")) != FALSE) {
			while (!feof($file)) {
				$data = fgets($file);
				if ($this->count == -1) {
					$this->length = $data;
					echo "length = $this->length";
					$this->count++;
				} else {
					$this->nodeArr[$i] = new Node($data,$this->count++);
					echo $this->nodeArr[$i]->id." ";
					echo $this->nodeArr[$i]->path." ";
					//echo $nodeArr[$i]->active;
					$i++;
					 
				}
			}
		}	
		fclose($file);
	}	

	function traverseNodes() {
		$currentPos = 0;

		for ($i = 0; $i < $this->length ; $i++) {
			if ($this->nodeArr[$i]->active == FALSE) {
				$i++;
				$currentPos = $i;
				echo "node at ".$this->nodeArr[$i]->id." is".$this->nodeArr[$i]->active;
			} else {
				while ($this->nodeArr[$currentPos]->active == TRUE) {
					$this->nodeArr[$currentPos]->active = FALSE;
					$currentPos = $this->nodeArr[$currentPos]->path;
					echo "currentPos = ".$currentPos; 
				}
			}
		}
	}


}

$node1 = new NewNode(7);
$node1->traverseNodes();

?> 
 