<?php
require 'Classes/Cars/Honda.php';
require 'Classes/Cars/Nissan.php';
require 'Classes/Cars/Ferrari.php';
require 'Classes/Cars/Toyota.php';

$created_cars = [];
function randomCreateHonda(){
    $res_list = [];
    $num = mt_rand(1,20);
    for($i = 0; $i < $num; $i++){
        $res_list[] = new Honda();
    }
    return $res_list;
}

function randomCreateNissan(){
    $res_list = [];
    $num = mt_rand(1,20);
    for($i = 0; $i < $num; $i++){
        $res_list[] = new Nissan();
    }
    return $res_list;
}

function randomCreateFerrari(){
    $res_list = [];
    $num = mt_rand(1,20);
    for($i = 0; $i < $num; $i++){
        $res_list[] = new Ferrari();
    }
    return $res_list;
}

// 値段取得関数
function getPrice($car_object){
    return $car_object->getPrice();
}

function printStatistics($car_list){
    // 合計金額
    $sum_price = array_sum(array_map('getPrice',$car_list));
    // 合計台数
    $sum_cars = count($car_list);
    // 平均金額
    $ave_price = round($sum_price / $sum_cars);
    echo 
    "
    合計金額：{$sum_price}万円
    平均金額：{$ave_price}万円
    ";
    
}

$honda_list = randomCreateHonda();
$nussan_list = randomCreateNissan();
$ferrari_list = randomCreateFerrari();

$created_cars = array_merge($honda_list,$nussan_list,$ferrari_list);

printStatistics($created_cars);

?>