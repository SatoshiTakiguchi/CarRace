<?php

require 'Classes/Cars/Cars.php'; // ここで呼ばれてる'Classes/Calc.php';
require 'Classes/Cars/Honda.php';
require 'Classes/Cars/Nissan.php';
require 'Classes/Cars/Ferrari.php';
require 'Classes/Cars/Toyota.php';


$created_cars = [];
$honda_list = Cars::randomCreate("Honda");
$nussan_list = Cars::randomCreate("Nissan");
$ferrari_list = Cars::randomCreate("Ferrari");

$created_cars = array_merge($honda_list,$nussan_list,$ferrari_list);

Calc::printStatistics($created_cars);

?>