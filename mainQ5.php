<?php

require 'Classes/Cars/Honda.php';
require 'Classes/Cars/Nissan.php';
require 'Classes/Cars/Ferrari.php';
require 'Classes/Cars/Toyota.php';

require 'Classes/Fields.php';

$field = new Fields();

$honda = new Honda();
$nissan = new Nissan();
$ferrari = new Ferrari();
$toyota = new Toyota();

// ドライバー乗車
$honda->memberCountUp();
$nissan->memberCountUp();
$ferrari->memberCountUp();
$toyota->memberCountUp();
// レース参加
$field->addCar($honda);
$field->addCar($nissan);
$field->addCar($ferrari);
$field->addCar($toyota);

// レーススタート
$field->gameStart();


?>