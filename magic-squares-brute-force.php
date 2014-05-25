<?php

/*****
 * PHP Magic Squares brute force 
 * Ryan O'Connell - 05/2014 
 */

include_once('MagicSquareFactory.php');
include_once('MagicSquare.php');

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
            <li>Enter at least one value.</li>
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
