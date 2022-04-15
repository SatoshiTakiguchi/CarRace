<?php
require 'Classes/Cars/Honda.php';
require 'Classes/Cars/Nissan.php';
require 'Classes/Cars/Ferrari.php';
require 'Classes/Cars/Toyota.php';

$honda = new Honda();
$nissan = new Nissan();
$ferrari = new Ferrari();

echo "\n（0人で下車の処理）\n";
$honda->Q4();
echo "//乗車";
$honda->memberCountDown();

echo "\n//乗車人数と加速度の関係\n";
$honda->Q4();
echo "\n(乗車)\n";
$honda->memberCountUp();
$honda->Q4();
echo "\n(乗車)\n";
$honda->memberCountUp();
$honda->Q4();
echo "\n(下車)\n";
$honda->memberCountDown();
$honda->Q4();

echo "\n//乗車人数上限処理\n";
$ferrari->memberCountUp();
$ferrari->memberCountUp();
$ferrari->Q4();
echo "\n(乗車)\n";
$ferrari->memberCountUp();

?>