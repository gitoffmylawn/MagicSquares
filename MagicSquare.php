<?php

/*****
 * Magic Square Class
 *****/
class MagicSquare {
    
    public $magicArray;
    public $perm;
    
    public function __construct($array) {
        $this->magicArray = $array;
    }
    
    public function printArray() {
        print_r($this->magicArray);
    }
    
    public function hasDuplicates($array){
        $duplicateArray = array();
        foreach($array as $val){
            foreach($duplicateArray as $d){
                if($val === $d && $val !== ''){
                    return true;
                }
            }
            array_push($duplicateArray, $val);
        }
        return false;
    }
    
    /*****
     * Checks that no duplicate numbers exist
     * Checks number range is 0 > x > 10
     * Multiple 0's can exist
     */
    public function isChecked(){
        foreach($this->magicArray as $a){
            if($a > 9 || $a < 0){
                return false;
            }elseif($this->hasDuplicates($this->magicArray)){
                return false;
            }
        }
        return true;
     }

    /*****
     * Checks to see if it matches input 
     *****/    
    public function isSolution($array){
        $isSolution = false;
        for($i = 0; $i < count($this->magicArray); $i++){
            if($this->magicArray[$i] != ""){
                if($this->magicArray[$i] == $array[$i]){
                    $isSolution = true;
                }else{
                    return false;
                }
            }
        }
        //print_r($array); 
        return $isSolution;
    }
    
    /*****
     * Checks to see if it is a magic square
     *****/
    public function isMagicSquare($array){
        $isMagicSquare = false;
        if($array[0] + $array[1] + $array[2] === 15 &&
           $array[3] + $array[4] + $array[5] === 15 &&
           $array[6] + $array[7] + $array[8] === 15 &&
           $array[0] + $array[3] + $array[6] === 15 &&
           $array[1] + $array[4] + $array[7] === 15 &&
           $array[2] + $array[5] + $array[8] === 15){
           $isMagicSquare = true;
        }
        return $isMagicSquare;
    }
    
    /*****
     * Modified from O'Reilly
     *****/
    public function pc_permute($items, $perms = array( )){
        if(empty($items)){
            if($this->isSolution($perms) && $this->isMagicSquare($perms)){ 
                $this->perm = $perms;
            }
        }else{
            for ($i = count($items) - 1; $i >= 0; --$i) {
                $newitems = $items;
                $newperms = $perms;
                list($foo) = array_splice($newitems, $i, 1);
                array_unshift($newperms, $foo);
                $this->pc_permute($newitems, $newperms);
            }
        }
        return $this->perm;
    }

    public function solve(){
        $permutation = array(1,2,3,4,5,6,7,8,9);
        $solution = $this->pc_permute($permutation);
        return $solution;
        //print_r($solution);
    }
}