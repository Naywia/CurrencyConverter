<?php

session_start();

$one = filter_input(INPUT_GET, "one");
$c = filter_input(INPUT_GET, "c");
$val1 = filter_input(INPUT_GET, "val1");
$val2 = filter_input(INPUT_GET, "val2");
$_SESSION['selected1'] = $val1;
$_SESSION['selected2'] = $val2;

$rateX = $_SESSION['selected1'];
$rateZ = $_SESSION['selected2'];

if (strstr($rateX, ",")) {
    $rateX = str_replace(",", ".", $rateX); // replace ',' with '.'
}
if (strstr($rateZ, ",")) {
    $rateZ = str_replace(",", ".", $rateZ); // replace ',' with '.'
}

if ($one == "true") {
    $numberY = $c / 100 * $rateX;
    $number2 = $numberY / $rateZ * 100;
    $result = bcdiv($number2, 1, 2);
} else if ($one == "false") {
    $numberY = $c / 100 * $rateZ;
    $number2 = $numberY / $rateX * 100;
    $result = bcdiv($number2, 1, 2);
}

echo $result;
?>