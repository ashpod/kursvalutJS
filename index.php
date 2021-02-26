<?php
function curl_content($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; WinNT; en; rv:1.0.2) Gecko/20030311 Beonex/0.8.2-stable');
//curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefiles);
//curl_setopt($ch, CURLOPT_NOBODY,true);
//curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefiles);

    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//////курл
    $html = curl_exec($ch);
    return $html;
    unset($url);
}

$uan = 1;
$url = "https://finance.i.ua/nbu/";

$html = curl_content($url);
preg_match("/Российский рубль(\D{0,100})(\d{0,10}.\d{0,10})(<\/span>)/", $html, $rub);
//$rub[1] - курс рубля
preg_match("/Доллар США(\D{0,100})(\d{0,10}.\d{0,10})(<\/span>)/", $html, $usd);
//$usa[1] - курс доллара
preg_match("/Евро(\D{0,100})(\d{0,10}.\d{0,10})(<\/span>)/", $html, $evr);
//$evr[1] - курс доллара
?>

<h1>Курс Валют</h1>

<h1>RUB</h1>
<span id="rub"><?php echo $rub[2]; ?></span>
<h1>USD</h1>
<span id="usd"><?php echo $usd[2]; ?></span>
<h1>EVR</h1>
<span id="evr"><?php echo $evr[2]; ?></span>

<form name="form">
    <select name="val_1" id="val_1" oninput="moneyConverter_2()" onchange="moneyConverter_2()">
        <option value="UAN">UAN</option>
        <option value="RUB">RUB</option>
        <option value="USD">USD</option>
        <option value="EVR">EVR</option>
    </select>
    <input type="text" name="x" id="x" oninput="moneyConverter_1()" onchange="moneyConverter_1()"/><br/>


    <select name="val_2" id="val_2" oninput="moneyConverter_1()" onchange="moneyConverter_1()">
        <option value="UAN">UAN</option>
        <option value="RUB">RUB</option>
        <option value="USD">USD</option>
        <option value="EVR">EVR</option>
    </select>
    <input type="text" name="y" id="y" oninput="moneyConverter_2()" onchange="moneyConverter_2()"/><br/>
</form>
<p><span id="calculate"></span></p>
<script>
    function moneyConverter_1() {
        var uan = 1;
        var rub = document.getElementById("rub").innerHTML;
        var usd = document.getElementById("usd").innerHTML;
        var evr = document.getElementById("evr").innerHTML;

        var valNum = document.getElementById("x").value;
        var value_text = document.getElementById("val_1");  //для гривны устанавливаем 1
        var val_num_text = value_text.options[value_text.selectedIndex].text;

        if (val_num_text == "UAN") {
            var e = document.getElementById("val_2");
            var valu = e.options[e.selectedIndex].value;
            if (valu == "UAN") {
                document.getElementById("y").value = valNum;
            }
            if (valu == "RUB") {
                document.getElementById("y").value = uan / rub * valNum;
            }
            if (valu == "USD") {
                document.getElementById("y").value = uan / usd * valNum;
            }
            if (valu == "EVR") {
                document.getElementById("y").value = uan / evr * valNum;
            }
            // document.getElementById("y").value = valNum * valu;
            // calculate.innerHTML = valu;
        }
        if (val_num_text == "RUB") {
            var e = document.getElementById("val_2");
            var valu = e.options[e.selectedIndex].value;
            if (valu == "UAN") {
                document.getElementById("y").value = rub / uan * valNum;
            }
            if (valu == "RUB") {
                document.getElementById("y").value = valNum;
            }
            if (valu == "USD") {
                document.getElementById("y").value = rub / usd * valNum;
            }
            if (valu == "EVR") {
                document.getElementById("y").value = rub / evr * valNum;
            }
        }
        if (val_num_text == "USD") {
            var e = document.getElementById("val_2");
            var valu = e.options[e.selectedIndex].value;
            if (valu == "UAN") {
                document.getElementById("y").value = usd / uan * valNum;
            }
            if (valu == "RUB") {
                document.getElementById("y").value = usd / rub * valNum;
            }
            if (valu == "USD") {
                document.getElementById("y").value = valNum;
            }
            if (valu == "EVR") {
                document.getElementById("y").value = usd / evr * valNum;
            }
        }
        if (val_num_text == "EVR") {
            var e = document.getElementById("val_2");
            var valu = e.options[e.selectedIndex].value;
            if (valu == "UAN") {
                document.getElementById("y").value = evr / uan * valNum;
            }
            if (valu == "RUB") {
                document.getElementById("y").value = evr / rub * valNum;
            }
            if (valu == "USD") {
                document.getElementById("y").value = evr / usd * valNum;
            }
            if (valu == "EVR") {
                document.getElementById("y").value = uan / evr * valNum;
            }
        }
    }

    function moneyConverter_2() {
        var uan = 1;
        var rub = document.getElementById("rub").innerHTML;
        var usd = document.getElementById("usd").innerHTML;
        var evr = document.getElementById("evr").innerHTML;

        var valNum = document.getElementById("y").value;
        var value_text = document.getElementById("val_2");
        var val_num_text = value_text.options[value_text.selectedIndex].text; //добыли option value 1го селекта

        if (val_num_text == "UAN") {
            var e = document.getElementById("val_1");
            var valu = e.options[e.selectedIndex].value;
            if (valu == "UAN") {
                document.getElementById("x").value = valNum;
            }
            if (valu == "RUB") {
                document.getElementById("x").value = uan / rub * valNum;
            }
            if (valu == "USD") {
                document.getElementById("x").value = uan / usd * valNum;
            }
            if (valu == "EVR") {
                document.getElementById("x").value = uan / evr * valNum;
            }
            // document.getElementById("y").value = valNum * valu;
            // calculate.innerHTML = valu;
        }
        if (val_num_text == "RUB") {
            var e = document.getElementById("val_1");
            var valu = e.options[e.selectedIndex].value;
            if (valu == "UAN") {
                document.getElementById("x").value = rub / uan * valNum;
            }
            if (valu == "RUB") {
                document.getElementById("x").value = valNum;
            }
            if (valu == "USD") {
                document.getElementById("x").value = rub / usd * valNum;
            }
            if (valu == "EVR") {
                document.getElementById("x").value = rub / evr * valNum;
            }
        }
        if (val_num_text == "USD") {
            var e = document.getElementById("val_1");
            var valu = e.options[e.selectedIndex].value;
            if (valu == "UAN") {
                document.getElementById("x").value = usd / uan * valNum;
            }
            if (valu == "RUB") {
                document.getElementById("x").value = usd / rub * valNum;
            }
            if (valu == "USD") {
                document.getElementById("x").value = valNum;
            }
            if (valu == "EVR") {
                document.getElementById("x").value = usd / evr * valNum;
            }
        }
        if (val_num_text == "EVR") {
            var e = document.getElementById("val_1");
            var valu = e.options[e.selectedIndex].value;
            if (valu == "UAN") {
                document.getElementById("x").value = evr / uan * valNum;
            }
            if (valu == "RUB") {
                document.getElementById("x").value = evr / rub * valNum;
            }
            if (valu == "USD") {
                document.getElementById("x").value = evr / usd * valNum;
            }
            if (valu == "EVR") {
                document.getElementById("x").value = valNum;
            }
        }
    }
    document.getElementsByTagName('input')[0].onkeypress = function(e) {

        e = e || event;

        if (e.ctrlKey || e.altKey || e.metaKey) return;

        var chr = getChar(e);

        // с null надо осторожно в неравенствах, т.к. например null >= '0' => true!
        // на всякий случай лучше вынести проверку chr == null отдельно
        if (chr == null) return;

        if (chr < '0' || chr > '9') {
            return false;
        }

    }
    document.getElementsByTagName('input')[1].onkeypress = function(e) {

        e = e || event;

        if (e.ctrlKey || e.altKey || e.metaKey) return;

        var chr = getChar(e);

        // с null надо осторожно в неравенствах, т.к. например null >= '0' => true!
        // на всякий случай лучше вынести проверку chr == null отдельно
        if (chr == null) return;

        if (chr < '0' || chr > '9') {
            return false;
        }

    }

    function getChar(event) {
        if (event.which == null) {
            if (event.keyCode < 32) return null;
            return String.fromCharCode(event.keyCode) // IE
        }

        if (event.which != 0 && event.charCode != 0) {
            if (event.which < 32) return null;
            return String.fromCharCode(event.which) // остальные
        }

        return null; // специальная клавиша
    }
</script>
