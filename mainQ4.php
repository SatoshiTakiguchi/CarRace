<?php
require 'Classes/Cars/Honda.php';
require 'Classes/Cars/Nissan.php';
require 'Classes/Cars/Ferrari.php';
require 'Classes/Cars/Toyota.php';

$honda = new Honda();
$nissan = new Nissan();
$ferrari = new Ferrari();

echo "//乗車人数と加速度の関係\n";
$honda->showCarData();
echo "\n（0人で下車の処理）\n";
$honda->memberCountDown();
$honda->showCarData();

echo "\n乗車\n";
$honda->memberCountUp();
$honda->showCarData();
echo "\n乗車\n";
$honda->memberCountUp();
$honda->showCarData();
echo "\n下車\n";
$honda->memberCountDown();
$honda->showCarData();
echo "\n";

echo "//Nissanの加速度確認\n";
$nissan->showCarData();
echo "\n";


echo "//乗車人数上限処理\n";
$ferrari->memberCountUp();
$ferrari->memberCountUp();
$ferrari->showCarData();
echo "\n乗車\n";
$ferrari->memberCountUp();

?>