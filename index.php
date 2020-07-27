<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Currency Converter</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

        <?php
        $url = "https://www.nationalbanken.dk/_vti_bin/DN/DataService.svc/CurrencyRatesXML?lang=da";
        $xml = simplexml_load_file($url);
        echo "
        <form action='calculate.php' method='post'>
            <div class='firstNumber'>
                <input name='number1' type='number' placeholder='0' step='0.01'>
                <select name='currency1' id='currency'>";
                    foreach ($xml->dailyrates->currency as $currency) {
                        echo "<option value='" . $currency['rate'] . "'>" . $currency['desc'] . "</option>";
                    }
                    echo "
                </select>
            </div>
        
            <div class='secondNumber'>
                <input name='number2' id='2' type='number' step='0.01'>
                <select name='currency2' id='currency2'>";
                    foreach ($xml->dailyrates->currency as $currency) {
                        echo "<option value='" . $currency['rate'] . "'>" . $currency['desc'] . "</option>";
                    }
                    echo "
                </select>
            </div>
            <input name='submit' type='submit' value='Omregn'>
        </form>";
        
        ?>
    </body>
</html>
