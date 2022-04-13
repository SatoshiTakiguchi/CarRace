<?php
require 'Classes/Cars.php';

$ferrari = new Ferrari(1000);

$ferrari->showCarData();

$ferrari->heightChange();
$ferrari->showCarData();

$ferrari->heightChange();
$ferrari->showCarData();
?>