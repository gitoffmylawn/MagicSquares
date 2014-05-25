<?php

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

?>