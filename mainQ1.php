<?php
require 'Classes/Cars/Honda.php';
require 'Classes/Cars/Nissan.php';
require 'Classes/Cars/Ferrari.php';
require 'Classes/Cars/Toyota.php';

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