<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Valuta Omregner</title>
        
        <link rel="apple-touch-icon" sizes="180x180" href="image/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="image/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="image/favicon-16x16.png">
        
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="header">
            <div class="innerHeader">
                <header class="head">Valuta Omregner</header>
            </div>
        </div>
        <div class="main">
            <?php
            $url = "https://www.nationalbanken.dk/_vti_bin/DN/DataService.svc/CurrencyRatesXML?lang=da";
            $xml = simplexml_load_file($url);
            ?>

            <form action='calculate.php' method='post'>
                <div class="numbers">
                    <div class='firstNumber'>
                        <input class="values" name='number1' type='number' onfocus="this.value = ''" step='0.01' value="<?php echo $_SESSION['number1']; ?>">
                        <select name='currency1' id='currency' class="currency">;
                            <?php
                            foreach ($xml->dailyrates->currency as $currency) {
                                echo "<option";
                                if ($_SESSION['selected1'] == $currency['rate']) {
                                    echo " selected";
                                }
                                echo" value='" . $currency['rate'] . "'>" . $currency['desc'] . "</option>";
                            }
                            if ($_SESSION['selected1'] != 100) {
                                echo "<option value='100'>Danske Kroner</option>";
                            } else {
                                echo "<option value='100' selected>Danske Kroner</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class='secondNumber'>
                        <input class="values" name='number2' id='number2' type='number' step='0.01' onfocus="this.value = ''" value="<?php echo $_SESSION['number2']; ?>">
                        <select name='currency2' id='currency2' class="currency">";
                            <?php
                            foreach ($xml->dailyrates->currency as $currency) {
                                echo "<option";
                                if ($_SESSION['selected2'] == $currency['rate']) {
                                    echo " selected";
                                }
                                echo" value='" . $currency['rate'] . "'>" . $currency['desc'] . "</option>";
                            }
                            if ($_SESSION['selected2'] != 100) {
                                echo "<option value='100'>Danske Kroner</option>";
                            } else {
                                echo "<option value='100' selected>Danske Kroner</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class='button'>
                    <input id="butt" name='submit' type='submit' value='OMREGN'>
                </div>

            </form>
        </div>
    </body>
</html>
