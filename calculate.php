<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Currency Converter</title>
        <link rel="stylesheet" href="style.css">
        <script src="changePlaceholder.js"></script>
    </head>
    <body>
        <?php
        $url = "https://www.nationalbanken.dk/_vti_bin/DN/DataService.svc/CurrencyRatesXML?lang=da";
        $xml = simplexml_load_file($url);
        
        $number1 = $_POST['number1'];

        $currency1 = $_POST['currency1'];
        echo $currency1;
        foreach ($xml->dailyrates->currency as $currency) {
            if ($currency['rate'] == $currency1) {
                $numberX = $currency1;
                echo 'x';
            }
        }
        $number2 = $number1 / 100 * $numberX;
        //echo '<script type="text/javascript"> changePlaceholder('. $number2 .'); </script>';
        //header('refresh:0; url=index.php');
        ?>
    </body>
</html>



