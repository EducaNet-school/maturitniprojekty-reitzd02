<?php
$a = 1254;
$tisic = array();
$sto = array();
$padesat = array();
$jedna = array();

function rozmena($a, &$tisic)
{
    while ($a >= 1000) {
        if ($a >= 1000) {
            $a -= 1000;
            array_push($tisic, 1000);
        }
    }
    return $a;
}
function rozmena2($a, &$sto)
{
    while ($a >= 100) {
        if ($a >= 100) {
            $a -= 100;
            array_push($sto, 100);
        }
    }
    return $a;
}
function rozmena3($a, &$padesat)
{
    while ($a >= 50) {
        if ($a >= 50) {
            $a -= 50;
            array_push($padesat, 50);
        }
    }
    return $a;
}
function rozmena4($a, &$deset)
{
    while ($a >= 10) {
        if ($a >= 10) {
            $a -= 10;
            array_push($deset, 10);
        }
    }
    return $a;
}
function rozmena5($a, &$jedna)
{
    while ($a >= 1) {
        if ($a >= 1) {
            $a -= 1;
            array_push($jedna, 1);
        }
    }
    return $a;
}
$a = rozmena($a, $tisic);
$a = rozmena2($a, $sto);
$a = rozmena3($a, $padesat);
$a = rozmena4($a, $deset);
$a = rozmena5($a, $jedna);

echo "zbyvajici castka " . $a . "<br>";
echo implode(", ", $tisic);
echo "<br>";
echo implode(", ", $sto);
echo "<br>";
echo implode(", ", $padesat);
echo "<br>";
echo implode(", ", $deset);
echo "<br>";
echo implode(", ", $jedna);
