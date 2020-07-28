<?php
ini_set('session.gc_maxlifetime', 300);
session_set_cookie_params(300);
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Currency Converter</title>
        
        <link rel="apple-touch-icon" sizes="180x180" href="image/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="image/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="image/favicon-16x16.png">
        
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="header">

        </div>
        <div class="main">

        </div>
        <?php
        $url = "https://www.nationalbanken.dk/_vti_bin/DN/DataService.svc/CurrencyRatesXML?lang=da";
        $xml = simplexml_load_file($url);

        $number1 = filter_input(INPUT_POST, 'number1');

        $currency1 = filter_input(INPUT_POST, 'currency1');
        $currency2 = filter_input(INPUT_POST, 'currency2');

        //SESSIONS USED ON INDEX PAGE
        $_SESSION['selected1'] = $currency1;
        $_SESSION['selected2'] = $currency2;
        $_SESSION['number1'] = $number1;

        if (strstr($currency1, ",")) {
            $currency1 = str_replace(",", ".", $currency1); // replace ',' with '.'
        }
        if (strstr($currency2, ",")) {
            $currency2 = str_replace(",", ".", $currency2); // replace ',' with '.'
        }

        $RateX = $currency1;
        $RateZ = $currency2;


        $numberY = $number1 / 100 * $RateX;
        $number2 = $numberY / $RateZ * 100;
        $_SESSION['number2'] = bcdiv($number2, 1, 2);
        header('refresh:0; url=index.php');
        ?>
    </body>
</html>



