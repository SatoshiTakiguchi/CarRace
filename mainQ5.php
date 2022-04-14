<?php
require 'Classes/Cars.php';
require 'Classes/Fields.php';

$field = new Fields();

$honda = new Honda();
$honda->memberCountUp();
$field->addCar($honda);

$ferrari = new Ferrari();
$ferrari->memberCountUp();
$field->addCar($ferrari);

$field->gameStart();


?>