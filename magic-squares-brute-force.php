<?php

/*****
 * PHP Magic Squares brute force 
 * Ryan O'Connell - 05/2014 
 */

error_reporting( E_ALL );

/*****
 * Magic Square Factory class
 *****/
class MagicSquareFactory{
    
    public static function create(){
        $magicFac = new MagicSquareFactory();
        return new MagicSquare($magicFac->getPosts());
    }
    
    public function getPosts(){
        $magicArray = array();
        if(isset($_POST['1'])){array_push($magicArray, $_POST['1']); }else{ array_push($magicArray, 0);}
        if(isset($_POST['2'])){array_push($magicArray, $_POST['2']); }else{ array_push($magicArray, 0);}
        if(isset($_POST['3'])){array_push($magicArray, $_POST['3']); }else{ array_push($magicArray, 0);}
        if(isset($_POST['4'])){array_push($magicArray, $_POST['4']); }else{ array_push($magicArray, 0);}
        if(isset($_POST['5'])){array_push($magicArray, $_POST['5']); }else{ array_push($magicArray, 0);}
        if(isset($_POST['6'])){array_push($magicArray, $_POST['6']); }else{ array_push($magicArray, 0);}
        if(isset($_POST['7'])){array_push($magicArray, $_POST['7']); }else{ array_push($magicArray, 0);}
        if(isset($_POST['8'])){array_push($magicArray, $_POST['8']); }else{ array_push($magicArray, 0);}
        if(isset($_POST['9'])){array_push($magicArray, $_POST['9']); }else{ array_push($magicArray, 0);}
        return $magicArray;
    }
    
}

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

$error = "";
$solution = array();

if(isset($_POST['solve'])){
    $magicSquareFac = new MagicSquareFactory();
    $magicSquare1 = $magicSquareFac->create();
    if($magicSquare1->isChecked()){
        $solution = $magicSquare1->solve();
        if(empty($solution)){
            $error = "
            <li>No solution found.</li>
            ";
        }
    }else{
        $error = "
        <li>No duplicates allowed.</li>
        <li>Only numbers 0 > x > 10 allowed.</li>
        ";
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Magic Squares</title>
        <style>
            .container {width: 400px; margin: 0px auto;}
            .number {width: 17px;}
            .sum {background: grey;}
        </style>
    </head>
    <body>
        <section class="container">
            <h1>Magic Squares</h1>
            <form action="magic-squares-brute-force.php" method="post">
                <div>
                    <input class="number" type="text" maxlength="1" name="1" value="<?php if(!empty($solution)){echo $solution[0];} ?>">
                    <input class="number" type="text" maxlength="1" name="2" value="<?php if(!empty($solution)){echo $solution[1];} ?>">
                    <input class="number" type="text" maxlength="1" name="3" value="<?php if(!empty($solution)){echo $solution[2];} ?>">
                    <input class="number sum" type="text" maxlength="0" name="r1sum" value="<?php if(!empty($solution)){echo $solution[0] + $solution[1] + $solution[2];} ?>">
                </div>
                <div>
                    <input class="number" type="text" maxlength="1" name="4" value="<?php if(!empty($solution)){echo $solution[3];} ?>">
                    <input class="number" type="text" maxlength="1" name="5" value="<?php if(!empty($solution)){echo $solution[4];} ?>">
                    <input class="number" type="text" maxlength="1" name="6" value="<?php if(!empty($solution)){echo $solution[5];} ?>">
                    <input class="number sum" type="text" maxlength="0" name="r2sum" value="<?php if(!empty($solution)){echo $solution[3] + $solution[4] + $solution[5];} ?>">
                </div>
                <div>
                    <input class="number" type="text" maxlength="1" name="7" value="<?php if(!empty($solution)){echo $solution[6];} ?>">
                    <input class="number" type="text" maxlength="1" name="8" value="<?php if(!empty($solution)){echo $solution[7];} ?>">
                    <input class="number" type="text" maxlength="1" name="9" value="<?php if(!empty($solution)){echo $solution[8];} ?>">
                    <input class="number sum" type="text" maxlength="0" name="r3sum" value="<?php if(!empty($solution)){echo $solution[6] + $solution[7] + $solution[8];} ?>">
                </div>
                <div>
                    <input class="number sum" type="text" maxlength="0" name="c1sum" value="<?php if(!empty($solution)){echo $solution[0] + $solution[3] + $solution[6];} ?>">
                    <input class="number sum" type="text" maxlength="0" name="c2sum" value="<?php if(!empty($solution)){echo $solution[1] + $solution[4] + $solution[7];} ?>">
                    <input class="number sum" type="text" maxlength="0" name="c3sum" value="<?php if(!empty($solution)){echo $solution[2] + $solution[5] + $solution[8];} ?>">
                </div>
                <input type="submit" name="solve" value="Solve" >
            </form>
<?php
    echo $error;
?>
        </section>
    </body>
</html>
