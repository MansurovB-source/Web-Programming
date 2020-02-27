<!DOCTYPE html>
<html>
<head>
	<title>Результат проверки</title>
  	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/handler_style.css">
</head>
<body>
<?php

session_start();

$start = microtime(true);

$x= (int) $_GET['x_h'];
$y= (float) $_GET['y_h'];
$r= (float) $_GET['r_h'];

$load= (boolean) $_GET['load'];

formAnswer($load, $x, $y, $r, $start);

// Main end

function formAnswer($load, $x, $y, $r, $start) {
    if ($load) {
        printTable(10); //Загрузка таблицы и хранение последних N запросов
    } else {
        if (!validate($x, $y, $r)) {
            array_push($_SESSION['arr'], false);
        } else {
            if (check($x, $y, $r))
                $check = true;
            else
                $check = false;

            $_SESSION['i']++;
            $n = $_SESSION['i'];

            $time = round((microtime(true) - $start) * 1000, 3);
            $currentTime = date("H:i:s", strtotime('+3 hour'));

            array_push($_SESSION['arr'], array($n, $x, $y, $r, $check, $currentTime, $time));
        }
        printTable(10);
    }
}

function check($x, $y, $r) {
    $firstQuarter = ($x >= 0 && $y >= 0 && ($x + $y - $r/2 ) <= 0);
    $secondQuarter = ($y >= 0 & $x <= 0 && (pow($x, 2) + pow($y, 2) <= (pow($r / 2, 2))));
    $thirdQuarter = ($x <= 0 && $y <= 0 && $y >= -$r && $x >= -$r/2);

    return $thirdQuarter || $secondQuarter || $firstQuarter;
}

function validate($x_arg, $y_arg, $r_arg)
{
    if (!(is_numeric($x_arg) && is_numeric($y_arg) && is_numeric($r_arg))) return false;

    $x_values = array(-5, -4, -3, -2, -1, 0, 1, 2, 3);
    $r_values = array(1, 1.5, 2, 2.5, 3);

    if (!in_array($x_arg, $x_values)) return false;
    if ($y_arg < -5 || $y_arg > 5) return false;
    if (!in_array($r_arg, $r_values)) return false;

    return true;
}

function printTable($limit) {
    echo "<table class=\"results\">";
    echo "<tr> <th>N</th> <th>X</th> <th>Y</th> <th>R</th> <th><b>Результат</b></th> <th>Время</th> <th>Время работы скрипта </th> <th>Показать </th> </tr>";

    while (count($_SESSION['arr']) >= $limit) array_shift($_SESSION['arr']);

    foreach ($_SESSION['arr'] as $item) {
        if (count($item) == 1)
            echo "<tr> <td colspan='8'><b>Неверные аргументы</b></td> </tr>";
        else {
            $res = $item[4] ? "Попадание" : "Промах";

            echo "<tr> <td>$item[0]</td> <td>$item[1]</td> <td>$item[2]</td> <td>$item[3]</td> <td><b>$res</b></td> <td>$item[5]</td>  <td>$item[6]  мс</td>  <td><button onclick='parent.markPoint($item[1], $item[2], $item[3])'>+</button></td></tr>";
        }
    }

    echo "</table> <br>";

}

?>
</body>
</html>