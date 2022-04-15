<?php

require 'Course.php';
require_once 'Calc.php';

class Fields{
    private $car_list = []; // 出場車のリスト
    private $minutes = 1000; // 制限時間
    private $course_range = 3000; // コースの長さ
    private $result = []; // 結果記録リスト

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

    // レース結果入力
    public function resultInput($car,$time){
        $name = $car['object']->getName();
        echo "{$name}はゴールしました。\n";
        $this->result[] = ['name' => "{$name}",'time' => $time];
    }

    // レース結果出力
    public function resultPrint(){
        $res_list = $this->result;
        for($i = 0; $i < count($res_list); $i++){
            $num = $i + 1;
            echo "
            {$num}位：{$res_list[$i]['name']}
            記録：{$res_list[$i]['time']}秒
            ";
        }
    }

    // 車の前進処理
    private function forwardCar(&$car_data,$time,$road){
        // ペナルティ時間処理
        if($car_data['penalty_time'] > 0){
            $car_data['penalty_time'] -= $time;
            return;
        }

        $velocity = $car_data['object']->getVelocity();

        // 道の許容速度処理
        if($road->getAllowableVelocity() < $velocity){
            $car_data['object']->setVelocity(10);
            $car_data['penalty_time'] = 1;
            echo "{$car_data['object']->getName()}はクラッシュした。\n";
        }

        $car_data['position'] += Calc::move($velocity, $time);
    }

    // レース開始
    public function gameStart(){
        $course = new Course($this->course_range);
        $delta_time = 0.5;
        echo "レーススタート\n";

        // 任意秒数ごとに更新
        for($i = 0 + $delta_time; $i < $this->minutes; $i += $delta_time){
            if(!$this->car_list){
                echo "終了";
                $this->resultPrint();
                break;
            }
            // すべての車の更新
            for($j = 0; $j < count($this->car_list); $j++){
                $car = &$this->car_list[$j];
                $car['object']->velocityUp($delta_time);
                $road = $course->getRoad($car['position']);
                $this->forwardCar($car,$delta_time,$road);
                if($car['position'] >= $this->course_range){
                    $this->resultInput($car,$i);
                    array_splice($this->car_list,$j,1);
                }
            }
            
            if($i % (float)5 == 0){
                print($i % (float)5 ."\n");
                // sleep(1);
                print($i."秒経過\n");
                $this->showPosition();
            }
        }
    }
}


?>