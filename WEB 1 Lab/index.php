<!DOCTYPE HTML>
<?php
session_set_cookie_params(3600 * 24);
session_start();

if (is_null($_SESSION['i'])) {
    $_SESSION['i'] = 0;
    $_SESSION['arr'] = array();
}

?>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Lab1-Web</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <script src="./js/mainFunctions.js"></script>
</head>
<body onload="init()">
<header>
    <h1>Проверка попадания точки в график</h1>
    Мансуров Бехруз P3210
    <br>Вариант - 210010
</header>
<div class="container">
    <div class="form">

        <p>X:
            <output name="x_output" id="x_out" class="output">0</output>
        </p>

        <table>
            <tr>
                <td><input type="button" name="x11" id="x_11" value=" -5" onclick="setX(x_11.value)"></td>
                <td><input type="button" name="x12" id="x_12" value=" -4" onclick="setX(x_12.value)"></td>
                <td><input type="button" name="x13" id="x_13" value="-3" onclick="setX(x_13.value)"></td>
            </tr>
            <tr>
                <td><input type="button" name="x21" id="x_21" value=" -2" onclick="setX(x_21.value)"></td>
                <td><input type="button" name="x22" id="x_22" value=" -1" onclick="setX(x_22.value)"></td>
                <td><input type="button" name="x23" id="x_23" value="0" onclick="setX(x_23.value)"></td>
            </tr>
            <tr>
                <td><input type="button" name="x31" id="x_31" value=" 1" onclick="setX(x_31.value)"></td>
                <td><input type="button" name="x32" id="x_32" value="2" onclick="setX(x_32.value)"></td>
                <td><input type="button" name="x33" id="x_33" value="3" onclick="setX(x_33.value)"></td>
            </tr>
        </table>

        <p>Y:
            <output name="y_output" id="y_out" class="output">0</output>
        </p>

        <span class="tooltip">
            <input type="text" name="y_input" maxlength="6" x id="y_in" value="0"
                   onblur="return verifyY(this);" oninput="return verifyY(this);">
            <span>Y координата должна быть числом в диапазоне [-3 ... 5]</span>
        </span>

        <p>R:
            <output name="r_output" id="r_out" class="output">1</output>
        </p>

        <p>
            <input type="radio" name="radius" class="rb" id="r_1" value="1" my-title="1" onclick="setRadius(r_1.value)">
            <input type="radio" name="radius" class="rb" id="r_1_5" value="1.5" my-title="1.5" onclick="setRadius(r_1_5.value)">
            <input type="radio" name="radius" class="rb" id="r_2" value="2" my-title="2" onclick="setRadius(r_2.value)">
            <input type="radio" name="radius" class="rb" id="r_2_5" value="2.5" my-title="2.5" onclick="setRadius(r_2_5.value)">
            <input type="radio" name="radius" class="rb" id="r_3" value="3" my-title="3" onclick="setRadius(r_3.value)">
        </p>

        <form method="GET" action="handler.php" target="result">
            <input type="hidden" name="x_h" id="x_h_id" value="0">
            <input type="hidden" name="r_h" id="r_h_id" value="1">
            <input type="hidden" name="y_h" id="y_h_id" value="0">
            <input type="hidden" name="load" id="load" value="1">

            <p><input type="submit" value="Проверить" onclick="markPoint(x_out.value, y_out.value, r_out.value)"></p>
        </form>

    </div>

    <div class="graphic">
        <canvas id="canvas" width="300" height="300"></canvas>
    </div>


</div>

<div>
    <iframe class="result" name="result"></iframe>
</div>

</body>
</html>