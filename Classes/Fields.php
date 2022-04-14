<?php

require 'Course.php';

class Fields{
    private $car_list = [];
    private int $minutes = 6;

    // 車の追加
    public function addCar($car){
        $car_data = [];
        $car_data['car_object'] = $car;
        $car_data['position'] = 0;
        $car_data['status'] = "nomal";
        $car_data['to_repaired'] = 0;
        $this->car_list[] = $car_data;
    }

    // 車の前進処理
    private function forwardCar(&$car_data,$time){
        $valocity = $car_data['car_object']->getVelocity();
        $car_data['position'] += $valocity * $time;
    }

    // レース開始
    public function gameStart(){
        $course = new Course();
        $delta_time = 0.5;
        echo "レーススタート\n";

        // 任意秒数ごとに更新
        for($i = 0 + $delta_time; $i < $this->minutes; $i += $delta_time){
            // sleep(1);
            print($i."秒経過\n");

            // すべての車の更新
            for($j = 0; $j < count($this->car_list); $j++){
                $car = $this->car_list[$j];
                $car['car_object']->velocityUp($delta_time);
                $road = $course->getRoad($car['position']);
                $this->forwardCar($car,$delta_time);
            }
        }
    }
}


?>