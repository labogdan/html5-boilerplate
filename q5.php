<?php 

/*
 * QUESTION 5 - Spiral Printing
 * Author: Andy Bogdan
 * 
 * This class takes as input an array.  It reads it and then outputs
 * it in spiral order
 * 
 * Input: file array of values
 * Output: same array is output, but in spiral order
 * 
 */

class TwoDArray {
    
    const DELIMITER = " ";  //declaring as constant, so it can be easily modified.
    
    private $arr = array();

    /*
     * Method to print out the array.
     * 
     */

    public function printArray($arr) {
        echo $arr." ";
    }

    /*
     * This method reads the file as a command line parameter.  It then calls
     * printArray() method to print it out.
     */
    
    public function readFileFromParam() {
        global $argv;
        $myArr = array();

        if (($file = fopen($argv[1], "r") or exit ("Sorry - file not found.")) != FALSE) {
            while (($data = fgetcsv($file,1000,self::DELIMITER)) != FALSE) { //TODO: need to make sure this doesn't stop at some arbitrary value
                $num = count($data);
                for ($c = 0; $c < $num; $c++) {
                     $this->printArray($data[$c]);
                }
            }
            
        }   
        fclose($file);
        
    }
    
}

$obj = new TwoDArray;
$obj->readFileFromParam();
    
?> 
 