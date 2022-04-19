<?php

require 'Classes/Cars/Honda.php';
require 'Classes/Cars/Nissan.php';
require 'Classes/Cars/Ferrari.php';
require 'Classes/Cars/Toyota.php';

require 'Classes/Course/Course.php';
require 'Classes/Fields.php';

// new Field(制限時間（秒）,クラッシュから復帰までの時間,sleep処理の有無,エンター入力待機の有無)
$field   = new Fields();

// new Course(コース全長, コーナー割合（％）)
$course  = new Course();
$field->addCourse($course);

$honda   = new Honda();
$nissan  = new Nissan();
$ferrari = new Ferrari();
$toyota  = new Toyota();
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