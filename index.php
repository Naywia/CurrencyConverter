<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Valuta Omregner</title>

        <link rel="apple-touch-icon" sizes="180x180" href="image/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="image/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="image/favicon-16x16.png">

        <link rel="stylesheet" href="style.css">
        <script type="text/javascript">
            function update(int) {
                var val1 = document.getElementById('currency1').value;
                var val2 = document.getElementById('currency2').value;
                if (int.lenght === 0) {
                    document.getElementById("number2").value = "";
                    return;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState === 4 && this.status === 200) {
                            document.getElementById("number2").value = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "calculate.php?c=" + int + "&val1=" + val1 + "&val2=" + val2 + "&one=true", true);
                    xmlhttp.send();
                }
            }

            function update2(int) {
                var val1 = document.getElementById('currency1').value;
                var val2 = document.getElementById('currency2').value;
                if (int.lenght === 0) {
                    document.getElementById("number1").value = "";
                    return;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState === 4 && this.status === 200) {
                            document.getElementById("number1").value = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "calculate.php?c=" + int + "&val1=" + val1 + "&val2=" + val2 + "&one=false", true);
                    xmlhttp.send();
                }
            }
        </script>
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

            if (empty($_SESSION['selected1'])) {
                $_SESSION['selected1'] = NULL;
            }
            if (empty($_SESSION['selected2'])) {
                $_SESSION['selected2'] = 100;
            }
            ?>

            <div class="numbers">
                <div class='firstNumber'>
                    <div class="numb">
                        <input class="values" name='number1' id='number1' type='number' onkeyup="update(this.value)" step='0.01'>
                    </div>
                    <select name='currency1' id='currency1'  class="currency">
                        <?php
                        foreach ($xml->dailyrates->currency as $currency) {
                            echo "<option";
                            if ($_SESSION['selected1'] == NULL && $currency['code'] == "USD") {
                                echo " selected";
                            } else if ($_SESSION['selected1'] == $currency['rate']) {
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
                    <div class="numb">
                        <input class="values" name='number2' id='number2' type='number' onkeyup="update2(this.value)" step='0.01'>
                    </div>
                    <select name='currency2' id='currency2' class="currency">
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
        </div>
    </body>
</html>
