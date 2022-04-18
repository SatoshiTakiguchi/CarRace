<?php

require 'Course/Course.php';
require_once 'Calc.php';
require 'Classes/Driver.php';

class Fields{
    private $car_list = []; // 出場車のリスト　車の追加参照
    private $minutes = 1000; // 制限時間
    private $course_range = 1000; // コースの長さ
    private $result = []; // 結果記録リスト

    // 車の追加
    public function addCar($car){
        $car_data = [];
        $car_data['object'] = $car;
        $car_data['position'] = 0;
        $car_data['status'] = "nomal";
        $car_data['penalty_time'] = 0;
        $car_data['crush_num'] = 0;
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
        $this->result[] = ['name' => "{$name}",'time' => $time, 'crush_num' => $car['crush_num']];
    }

    // レース結果出力
    public function printResult(){
        $res_list = $this->result;
        for($i = 0; $i < count($res_list); $i++){
            $num = $i + 1;
            echo "
            {$num}位：{$res_list[$i]['name']}
            記録：{$res_list[$i]['time']}秒
            クラッシュ回数：{$res_list[$i]['crush_num']}回
            ";
        }
    }

    // 途中結果リスト作成
    public function createProgress(){
        // 途中経過のリスト作成
        $res_list = [];
        foreach ($this->result as $car_data){
            $res_list[] = ['name' => $car_data['name'], '状態' => "ゴール"];
        }
        foreach ($this->car_list as $car_data){
            $res_list[] = ['name' => $car_data['object']->getName(), '状態' => "{$car_data['position']}m"];
        }
        return $res_list;
    }

    // 途中結果出力
    public function printProgress(){
        // 途中経過のリスト作成
        $res_list = $this->createProgress();
        
        // 途中経過の出力
        for($i = 0; $i < count($res_list); $i++){
            $car_data = $res_list[$i];
            $num = $i + 1;
            echo "{$num}位：{$car_data['name']} 現在位置：{$car_data['状態']}\n";
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
            // ペナルティ処理
            $car_data['object']->setVelocity(10);
            $car_data['penalty_time'] = 3;
            $car_data['crush_num'] += 1;

            echo "{$car_data['object']->getName()}はクラッシュした。\n\n";
            $this->sleep_s();
        }

        $car_data['position'] += Calc::move($velocity, $time);
    }

    // 並べ替え
    private function sortCars(){
        // 元の順位
        $origin_list = array_column($this->createProgress(),'name');

        // 並び替え
        $positions = array_column($this->car_list,'position');
        array_multisort($positions, SORT_DESC, $this->car_list);

        // 新しい順位
        $after_list = array_column($this->createProgress(),'name');

        // 順位変動があるなら
        if(array_diff_assoc($origin_list, $after_list)){
            echo "順位が変動した！\n";
            foreach($after_list as $key => $val){
                $origin = array_keys($origin_list, $val);
                $origin = $origin[0];
                if($key < $origin){
                    $s = $key + 1;
                    echo "{$s}位：{$val} ↑\n";
                }
                if($key > $origin){
                    $s = $key + 1;
                    echo "{$s}位：{$val} ↓\n";
                }
            }
            echo "\n";
            $this->sleep_s();
        }
    }

    // 車操作
    private function operationCar($car, $delta_time, $road){
        $road_type = $road->getType();
        $velocity = $car->getVelocity();

        // コーナー前かつ速度が50km/h以上なら
        if($road_type == "before_corner" && $velocity > 50){
            // 減速処理
            $num = Driver::brakeStrength();
            $car->velocityDown($delta_time, $num);
        }else{
            // 加速処理
            $car->velocityUp($delta_time);
        }
    }

    // コース表示
    private function printCourse($course_list){
        echo "コース概要\n";
        $course_names = [
            'straight' => "ストレート",
            'corner' => "コーナー",
            'before_corner' => "コーナー手前"
        ];
        $course_list = $course_list->getCourse();
        foreach($course_list as $course_data){
            $course = $course_data['course_object'];
            echo "{$course_names[$course->getType()]}:{$course->getDistance()}m\n";
        }
    }

    // レース開始
    public function gameStart(){
        $course = new Course($this->course_range);
        $this->printCourse($course);
        $this->sleep_s();

        $delta_time = 0.5;
        echo "レーススタート\n";

        $show_interval = 10;
        $object_time = $show_interval;
        // 任意秒数ごとに更新
        for($i = 0 + $delta_time; $i < $this->minutes; $i += $delta_time){
            // すべての車の更新
            for($j = 0; $j < count($this->car_list); $j++){
                // 車取得
                $car = &$this->car_list[$j];
                // 道取得
                $road = $course->getRoad($car['position']);
                // 車の操作
                $this->operationCar($car['object'], $delta_time, $road);
                
                // 前進処理
                $this->forwardCar($car,$delta_time,$road);
                // ゴール判定→結果リストに格納
                if($car['position'] >= $this->course_range){
                    $this->resultInput($car,$i);
                    array_splice($this->car_list,$j,1);
                    $this->sleep_s();
                }
            }

            // レース終了判定
            if(!$this->car_list){
                echo "終了";
                $this->printCourse($course);
                $this->printResult();
                break;
            }
            
            // 途中経過表示
            if($i == $object_time){
                print($i."秒経過\n");
                $this->sortCars();
                $this->sleep_s();
                $this->printProgress();
                echo "\n";
                $this->sleep_s();
                $object_time += $show_interval;
            }
        }
    }
    // sleep処理を一括でコメントするため
    private function sleep_s(){
        sleep(1);
    }
}


?>