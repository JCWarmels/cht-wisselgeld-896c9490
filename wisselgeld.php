<!DOCTYPE html>
<html>
<body>
<h1>Hoeveel geld wil je wisselen?</h1>
<form>
    <input type="number" name="amount"required>
</form>
<?php
define("GELDSOORTEUROS", [50,20,10,5,2,1]);
define("GELDSOORTCENTEN", [50,20,10,5]);
function defining($argv) {
    try{
    if(count($argv)<2) {
        throw new Exception("Je hebt geen bedrag meegegeven dat omgewisseld dient te worden.");
    }
    if($argv[1]<0) {
        throw new Exception("Ik kan geen negatief bedrag wisselen.");
    }
    if(!is_numeric($argv[1])){
        throw new Exception("Je hebt geen geldig bedrag meegegeven.");
    }
    $ToGive = floatval($argv[1]);
    $RestToGive = $ToGive;
    $RestToGive1 = $ToGive * 100;
    $RestToGiveRoundToFive = substr(roundUpToAny($RestToGive1), -2,2);
    $NewToGiveRest = $RestToGive1;
    $NewToGiveRest = substr_replace($NewToGiveRest, $RestToGiveRoundToFive, -2, 2);
    if($ToGive != 0){
        euros($RestToGive);
        cents($NewToGiveRest);
    }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

function roundUpToAny($n) {
    $x=5;
    return round($n/$x)*$x;
}
function euros($RestToGive) {
    foreach(GELDSOORTEUROS as $geldeenheid){
        if($RestToGive >= $geldeenheid){
            $HowFit = floor($RestToGive/$geldeenheid);
            $RestToGive = $RestToGive % $geldeenheid;
            echo($HowFit . " x " . $geldeenheid . " euros" . PHP_EOL);
        }
    }
}
function cents($NewToGiveRest) {
    foreach(GELDSOORTCENTEN as $geldeenheid1){
        $NewToGiveRest = substr($NewToGiveRest,-2,2);
        if($NewToGiveRest >= $geldeenheid1){
            $HowFit1 = floor($NewToGiveRest/$geldeenheid1);
            $NewToGiveRest = $NewToGiveRest % $geldeenheid1;
            echo($HowFit1 . " x " . $geldeenheid1 . " centen" . PHP_EOL);
        }
    }
}
if(isset($_POST["amount"])){
    defining($_POST["amount"]);
}


?>
</body>
</html>