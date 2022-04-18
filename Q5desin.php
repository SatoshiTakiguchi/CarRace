<?php

/*
設計

Q5.php
$field = new Field()

$car = new Toyota()
$field->addCar($car)

class Field{
    $course_list = ["road_object" => 道, "終了距離" => 終了距離]
    例
    [
        ["road_object" => ストレート, "終了距離" => 300],
        ["road_object" => コーナー, "終了距離" => 500],
        ...
    ]

    $car_list = [["object" => 車, "距離"　=> 現在距離]]


    "object"->acceleration();
    "object"->getVelocity();

    車の更新($delta_time){
        アクセル
        速度を取得

        car_list更新
        "距離" += （速度 * $delta_time）

        ブレーキ
        delta_timeの更新
    }

    $delta_time = 0.1
    for ($i = 0; $i < time; $i += $delta_time){

        車の前進()

        delta_timeの前進

        if($iが10の倍数の時){
            echo "{$i}秒経過"
        }
    }
}

*/


?>