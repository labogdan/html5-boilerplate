<?php 

/*
 * QUESTION 2 - Justifying Text
 * Author: Andy Bogdan
 * 
 * This class takes as input an integer, denoting width of a colum and
 * a string of text.  It outputs the text so that it is justified within
 * the specified width.
 * 
 * Input: file with integer and string of text
 * Output: Justified text, constrained to integer (width)
 * 
 */

class Justify {
	
    const CHARLIST = ".,;:?!'\"\\/`~@#$%^&*()-=+_[]{}|<>"; // List of punctuation that I will let in the text. 
    
    private $width = 0;
    private $originalArray = array();
    private $textToPrint = array();
    
    /*
     * This method reads the file as a command line parameter.  It assigns
     * the number to an integer and the text into an array of words.
     * 
     * $width will have the width from file
     * 
     * $originalArray will have the words from the file.
     * 
     */
	
	public function readFileFromParam() {
		global $argv;
		$myArr = array();
        $myString = "";
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
                $myString.=$myArr[$i];
            }
            $this->originalArray = explode(" ", $myString);
        } else die("Bad input - exiting.");

        
	}
	

    /*
     * This method takes the width specified and breaks up the data so that it conforms
     * to the width.  It modifies $this->textToPrint, an array where each element is
     * a line of text that is less than the width.
     * 
     * $textToPrint will contain all the words.  Each entry in the array will correspond
     * to one line of text, conformed to the width. 
     * 
     */

    public function applyWidth() {
        $curTarget = $this->width;
        $start = 0;
        $arrayByLine = array();
        $arrayByLineIndex = 0;
        $arraytoPrint = array();
        $temp = "";
        $localArray = $this->originalArray;
        
        for ($i = 0; $i < count($this->originalArray); $i++) {
            
            $val = strlen($temp) + strlen($localArray[$i]) + 1;  
            
            if (strlen($temp) + strlen($localArray[$i]) + 1 <= $this->width) {
                if (strlen($temp) == 0) {
                    $temp = $temp.$localArray[$i];
                } else {
                    $temp = $temp." ".$localArray[$i];
                }
            } else {

                $arrayByLine[$arrayByLineIndex] = $temp;
                $arrayByLineIndex++;
                $i--;
                $temp = "";
            }
            
            if ($i == count($this->originalArray) - 1) {
                $arrayByLine[$arrayByLineIndex] = $temp;
            }
        }
         
        $this->textToPrint = $arrayByLine;
    }
    
    /*
     * Method to justify the text.  It will calculate the difference between the desired width
     * and the length of each line.  It will then determine the number of spaces in the text.
     * From this, it will add whitespace starting in the middle, until it matches the length.
     * 
     * $textToPrint will hold the justified text, line by line.
     */
    
    public function justifyText() {
        $positions = array();
        for ($i = 0; $i < count($this->textToPrint); $i++) { // do this for each line of text

            $lineByLine = str_word_count($this->textToPrint[$i],1,self::CHARLIST);

            for ($j = 0; $j < count($lineByLine)-1; $j++) { // pad all words but last with trailing whitespace
                $lineByLine[$j] = $lineByLine[$j]. " ";
            }
            $whiteSpaces = count($lineByLine) - 1; 
            
             // this wasn't getting calculated correctly if there were multiple spaces, such as after a period in a sentence
            $localLength = 0;
            foreach ($lineByLine as $key => $value) {
                $localLength += strlen($value);
            }
            $spacesNeeded = $this->width - $localLength;
            
            if ($whiteSpaces > 0) { // dont' do this for a line containing only one word.
                
                $middle = (int) (($whiteSpaces+1)/2); // need to find middle of array
                $whereToInsert = $middle;
                $lkey = 1;
                $rkey = 1;
                $linc = 2;
                $rinc = 2;
                $rinit = $rkey;
                $linit = $lkey;

                if ($whiteSpaces % 2 == 0) { // if there are an even number of whitespaces, then we don't have a true middle, start at the right
                    $side = "right";
                } else {
                    $side = "middle";
                }

                while ($spacesNeeded > 0) {
                    
                    // insert to middle, then increment keys
                    if ($side == "middle") {
                        array_splice( $lineByLine, $whereToInsert, 0, " " );
                        $lkey++;
                        $rkey++;
                    }
                    
                    if($side == "right") {
                        $whereToInsert = $middle+$rkey;
                        if ($whereToInsert >= count($lineByLine)) {  // reached the end of array -- need to reset right side
                            $rkey = $rinit;
                            $whereToInsert = $middle+$rkey;
                        }
                        array_splice( $lineByLine, $whereToInsert, 0, " " );
                        $rkey+=$rinc;
                    } else if ($side == "left") {
                        $whereToInsert = $middle-$lkey;
                        if ($whereToInsert <= 0) {  //reached the end of array -- need to reset left side
                            $lkey = $linit;
                            $whereToInsert = $middle-$lkey;
                        }
                        array_splice( $lineByLine, $whereToInsert, 0, " " );
                        $lkey+=$linc;
                    }
                    
                    $middle = (int) (count($lineByLine)/2);
                    $side =  ($side == "right" ? "left" : "right");
                    $spacesNeeded--;
                }
                $this->textToPrint[$i] = implode("", $lineByLine);
            }
        }
    }
    
    /*
     * Method to print out the string of text. 
     * 
     */
    
	public function printText() {
		for ($i = 0; $i < count($this->textToPrint); $i++) {
		    echo $this->textToPrint[$i]."\n";
		}
	}
	
}

$obj = new Justify;

$obj->readFileFromParam();
$obj->applyWidth();
$obj->justifyText();
$obj->printText();	
?> 
 