<?php

require 'Classes/Cars/Honda.php';
require 'Classes/Cars/Nissan.php';
require 'Classes/Cars/Ferrari.php';
require 'Classes/Cars/Toyota.php';

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