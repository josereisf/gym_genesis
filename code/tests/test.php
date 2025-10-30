<?php
echo "primeiro";
// teste_debug.php
function soma($a, $b) {
    return $a + $b;
}
echo "segundo";

$a = 2;

$b = 3;

$a++;
$a++;

$a += 5;


$a += $b;
function principal() {
    $x = 10;
    $y = 20;
    $resultado = soma($x, $y);
    echo "Resultado: $resultado\n";
}
echo "terceiro";
principal();
echo "quarto";
echo "fim";