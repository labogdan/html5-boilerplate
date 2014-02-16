<?php 

class Word {
    public $length;
    public $offset;
    public $value;
    
    function Word($l, $o, $v) {
        $this->length = $l;
        $this->offset = $o;
        $this->value = $v;
    }
}

/*
 * This class takes as input an integer, denoting width of a colum and
 * a string of text.  It outputs the text so that it is justified within
 * the specified width.
 * 
 */

class Justify {
	
    const CHARLIST = ".,;:?!"; //TODO: need to make this more robust
    
    private $width = 0;
    private $originalString = "";
    private $originalArray = array();
    private $expandedArray = array();
    private $textToPrint = array();
    
    /*
     * This method reads the file as a command line parameter.  It assigns
     * the number to an integer and the text into a string.
     */
	
	public function readFileFromParam() {
		global $argv;
		$myArr = array();
        $len = 0;
        
		if (($file = fopen($argv[1], "r") or exit ("Sorry - file not found.")) != FALSE) {
			while (($data = fgets($file)) != FALSE) {
			    $myArr[$len] = $data;
                $len++; 
			}
		}	
		fclose($file);
        
        // make sure that we have input that we are expecting 
        if ($len >= 2) {
            $this->width = intval($myArr[0]);
            for ($i = 1; $i < $len; $i++) {
                $this->originalString.=$myArr[$i];
            }
            $this->originalArray = explode(" ", $this->originalString);
            $tmpArray = str_word_count($this->originalString,2,self::CHARLIST);
        } else die("Bad input - exiting.");

        foreach($tmpArray as $key=>$value) {
            for ($i = 0; $i < count($this->originalArray); $i++) {
                if ($value == $this->originalArray[$i]) { 
                    $this->expandedArray[$i] =  new Word(strlen($this->originalArray[$i]), $key, $this->originalArray[$i]);
                }
            }
        } 

        var_dump($this->expandedArray);
        
	}
	
    public function applyWidth() {
        $curTarget = $this->width;
        $start = 0;
        for ($i = 0; $i < count($this->expandedArray); $i++) {
            
            if ($this->expandedArray[$i]->length+$this->expandedArray[$i]->offset > $curTarget) {
                $this->textToPrint[(int) $curTarget/$this->width] = "";
                for ($j = $start; $j < $i; $j++) {
                    $this->textToPrint[(int) $curTarget/$this->width] .= $this->expandedArray[$j]->value." ";
                }
                $start = $j;
                $curTarget+= $this->width;
//                echo "break at ".$this->expandedArray[$i-1]->value;
            }
        }
        $this->textToPrint[(int) $curTarget/$this->width] = "";
        for ($j = $start; $j < $i; $j++) {
            $this->textToPrint[(int) $curTarget/$this->width] .= $this->expandedArray[$j]->value." ";
        }
        var_dump($this->textToPrint);
    }
    
	public function printArray() {
		
	}
	
}

$obj = new Justify;
$obj->readFileFromParam();
$obj->applyWidth();
	
?> 
 