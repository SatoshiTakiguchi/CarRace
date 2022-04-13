<?php
require 'Cars.php';

$honda = new Honda();
$nissan = new Nissan();
$ferrari = new Ferrari();

$honda->showCarData();
echo "\n";
$nissan->showCarData();
echo "\n";
$ferrari->showCarData();
echo "\n";
?>