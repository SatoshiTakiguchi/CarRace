<?php
require 'Classes/Cars.php';

function RandomCreateHonda(){
    $res_list = [];
    $num = mt_rand(1,20);
    $res_list[] = new Honda();
}

$honda = new Honda(400,8);
$nissan = new Nissan(300);
$ferrari = new Ferrari(1000);

$ferrari->showCarData();

$ferrari->heightChange();
$ferrari->showCarData();

$ferrari->heightChange();
$ferrari->showCarData();

?>