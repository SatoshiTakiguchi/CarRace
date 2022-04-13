<?php
require 'Classes/Cars.php';

$honda = new Honda(400,8);
$nissan = new Nissan(300);
$ferrari = new Ferrari(1000);

$ferrari->showCarData();

$ferrari->heightChange();
$ferrari->showCarData();

$ferrari->heightChange();
$ferrari->showCarData();
?>