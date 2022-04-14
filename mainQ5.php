<?php

require 'Classes/Cars/Honda.php';
require 'Classes/Cars/Nissan.php';
require 'Classes/Cars/Ferrari.php';
require 'Classes/Cars/Toyota.php';

require 'Classes/Fields.php';

$field = new Fields();

$honda = new Honda();
$ferrari = new Ferrari();

// ドライバー乗車
$honda->memberCountUp();
$ferrari->memberCountUp();
// レース参加
$field->addCar($honda);
$field->addCar($ferrari);

// レーススタート
$field->gameStart();


?>