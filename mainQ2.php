<?php
require 'Classes/Cars/Honda.php';
require 'Classes/Cars/Nissan.php';
require 'Classes/Cars/Ferrari.php';
require 'Classes/Cars/Toyota.php';

$ferrari = new Ferrari(1000);

$ferrari->Q2();
echo "\n";
$ferrari->heightChange();
$ferrari->Q2();

echo "\n";
$ferrari->heightChange();
$ferrari->Q2();
?>