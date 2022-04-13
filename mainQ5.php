<?php
require 'Classes/Cars.php';
require 'Classes/Fields.php';

$field = new Fields();

$honda = new Honda();
$field->addCar($honda);

$field->gameStart();


?>