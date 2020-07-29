<?php
session_start();

$c = filter_input(INPUT_GET, "c");


$rateX = $_SESSION['selected1'];
$rateZ = $_SESSION['selected2'];

if (strstr($rateX, ",")) {
    $rateX = str_replace(",", ".", $rateX); // replace ',' with '.'
}
if (strstr($rateZ, ",")) {
    $rateZ = str_replace(",", ".", $rateZ); // replace ',' with '.'
}

$numberY = $c / 100 * $rateX;
$number2 = $numberY / $rateZ * 100;
$result = bcdiv($number2, 1, 2);


echo $result == "" ? "no suggestions" : $result;
?>