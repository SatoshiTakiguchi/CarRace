<?php

class Fields{
    private $car_list = [];
    private int $minutes = 6;

    // 車の追加
    public function addCar($car){
        $car_data = [];
        $car_data['car_object'] = $car;
        $car_data['position'] = 0;
        $car_data['status'] = "nomal";
        $this->car_list[] = $car_data;
    }

    // 車の移動距離
    private function forwardDistance($car_data,$time){
        $valocity = $car_data['car_object']->getVelocity();
        return $valocity * $time;
    }
    // レース開始
    public function gameStart(){
        $delta_time = 0.1;
        echo "レーススタート\n";

        // 任意秒数ごとに更新
        for($i = 0 + $delta_time; $i < $this->minutes; $i += $delta_time){
            sleep(1);
            print($i."秒経過\n");

            // すべての車の更新
            for($j = 0; $j < count($this->car_list); $j++){
                $this->car_list[$j]['car_object']->velocityUp($delta_time);
                $this->car_list[$j]['position'] += $this->forwardDistance($this->car_list[$j],$delta_time);
                print($this->car_list[$j]['position']."\n");
            }
        }
        print_r($this->car_list);
    }
}


?>