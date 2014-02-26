<?php 

/*
 * QUESTION 3 - Following the Pointers
 * Author: Andy Bogdan
 * 
 * Input: file integer denoting number of nodes, and list of connections between nodes
 * Output: number of connections between nodes
 * 
 */
 
 
 
/* 
 * This is the base Node class.  It holds information about one single point (node)
 * in the puzzle.
 * 
 */

class Node {
	
	public $id;
	public $path;
	public $active = TRUE;
	
	function Node($destination, $id) {
		$this->id = $id;
		$this->path = intval($destination);
		$this->active = TRUE;
	}
}

/*
 * This class holds all instantiated nodes, as well as other parameters.
 * 
 * $length is the length of the list of nodes
 * $nodeArr is an array of all instantiated nodes
 * $numCycles is how many cycles are found 
 * 
 */

class NodeMap {

	private $length = 0;
	private $nodeArr = array();
	private $numCycles = 0;
	
    /*
     * Method that reads from file supplied at command line, instantiates
     * nodes, and creates map of all nodes.
     * 
     * nodeArr holds the map of all nodes.
     * 
     */
    
	public function readFileFromParam() {
		global $argv;
		$i = 0;
        $count = -1;
		
		if (($file = fopen($argv[1], "r") or exit ("Sorry - file not found.")) != FALSE) {
			while (!feof($file)) {
				$data = fgets($file);
				if ($count == -1) {
					$this->length = $data;
					$count++;
				} else {
					$this->nodeArr[$i] = new Node($data,$count++);
					$i++;
					 
				}
			}
		}
		fclose($file);
	}	

    /*
     * Prints out relevant properties of all nodes.
     * 
     */

    public function printNodes() {
        for ($i = 0; $i < $this->length; $i++) {
            echo $this->nodeArr[$i]->id." ";
            echo $this->nodeArr[$i]->path." ";
            echo $this->nodeArr[$i]->active."\n";
        }
        $this->printNumCycles();
    }

    /*
     * Prints out the number of cycles that have been found, from private variable numCycles.
     * 
     */

    public function printNumCycles() {
        echo $this->numCycles."\n";
    }

    /*
     * Traverses the nodes (nodeArr).  Each time a node is visited, it is marked
     * as 'seen' (active set to FALSE).  
     * 
     * Since we mark a node once we see it, we don't have to worry about
     * wasted time on nodes that have already been checked.
     * 
     * If we come across a time where the next node matches the first one
     * that initiated the crawl, then we increment numCycles.
     *  
     */
     
    public function traverseNodes() {
        $currentPos = 0;

        for ($i = 0; $i < $this->length ; $i++) {

            $currentPos = $i;
            if ($this->nodeArr[$currentPos]->active == TRUE && $this->nodeArr[$currentPos]->path!=-1) {
                    
                while ($this->nodeArr[$currentPos]->active == TRUE) {
                        
                    $this->nodeArr[$currentPos]->active = FALSE;
                    if ($this->nodeArr[$currentPos]->path!=-1) {
                            
                        $currentPos = $this->nodeArr[$currentPos]->path;
                        if ($currentPos == $i) {
                                
                            $this->numCycles++;
                        }
                    }
               }
           }
        }
    }


}

$node1 = new NodeMap();
$node1->readFileFromParam();
$node1->traverseNodes();
$node1->printNumCycles();

?> 
 