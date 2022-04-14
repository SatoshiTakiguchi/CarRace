<?php

require 'Course.php';

class Fields{
    private $car_list = [];
    private int $minutes = 6;

    // 車の追加
    public function addCar($car){
        $car_data = [];
        $car_data['object'] = $car;
        $car_data['position'] = 0;
        $car_data['status'] = "nomal";
        $car_data['penalty_time'] = 0;
        $this->car_list[] = $car_data;
    }

    // 車位置表示
    public function showPosition(){
        $cars = $this->car_list;
        for($i = 0; $i < count($cars); $i++){
            $name = $cars[$i]['object']->getName();
            $dist = $cars[$i]['position'];
            print("{$name}:{$dist}m"."\n");
        }
        echo "\n";
    }

    // 車の前進処理
    private function forwardCar(&$car_data,$time){
        if($car_data['penalty_time'] > 0){
            $car_data['penalty_time'] -= $time;
            return;
        }
        $valocity = $car_data['object']->getVelocity();
        $car_data['position'] += $valocity * $time;
    }

    // レース開始
    public function gameStart(){
        $course = new Course();
        $delta_time = 0.5;
        echo "レーススタート\n";

        // 任意秒数ごとに更新
        for($i = 0 + $delta_time; $i < $this->minutes; $i += $delta_time){
            // すべての車の更新
            for($j = 0; $j < count($this->car_list); $j++){
                $car = &$this->car_list[$j];
                $car['object']->velocityUp($delta_time);
                $road = $course->getRoad($car['position']);
                $this->forwardCar($car,$delta_time);
            }
            // sleep(1);
            print($i."秒経過\n");
            if($i == (int)$i){
                $this->showPosition();
            }
        }
    }
}


?>