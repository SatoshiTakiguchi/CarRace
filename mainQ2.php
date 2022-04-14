<?php
require 'Classes/Cars/Honda.php';
require 'Classes/Cars/Nissan.php';
require 'Classes/Cars/Ferrari.php';
require 'Classes/Cars/Toyota.php';

$ferrari = new Ferrari(1000);

$ferrari->showCarData();

$ferrari->heightChange();
$ferrari->showCarData();

$ferrari->heightChange();
$ferrari->showCarData();
?>