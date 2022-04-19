<?php

require 'Course/Course.php';
require_once 'Calc.php';
require 'Classes/Driver.php';

class Fields{
    private $car_list = []; // 出場車のリスト　車の追加参照
    private $limit; // 制限時間
    private $course_range; // コースの長さ
    private $corner_rate;
    private $result = []; // 結果記録リスト
    private $penalty_time;

    public function __construct(
        $course_range = 3000,
        $limit = 1000,
        $corner_rate = 50,
        $penalty_time = 2
    ){
        $this->course_range = $course_range;
        $this->limit = $limit;
        $this->corner_rate = $corner_rate;
        $this->penalty_time = $penalty_time;
    }

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
            $car_data['penalty_time'] = $this->penalty_time;
            $car_data['crush_num'] += 1;

            echo "{$car_data['object']->getName()}はクラッシュした。\n\n";
            $this->sleep_s();
        }

        $car_data['position'] += Calc::move($velocity, $time);
    }

    // 車操作
    private function operateCar($car, $delta_time, $road){
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

    // レース結果入力
    public function resultInput($car,$time){
        $name = $car['object']->getName();
        echo "{$name}はゴールしました。\n";
        $this->result[] = ['object' => $car['object'],'time' => round($time, 3), 'crush_num' => $car['crush_num']];
    }

    // レース結果出力
    public function printResult(){
        $res_list = $this->result;
        for($i = 0; $i < count($res_list); $i++){
            $num = $i + 1;
            $car = $res_list[$i]['object'];
            $acceleration = Calc::toKmPerSS($car->getAcceleration());
            echo "{$num}位：{$car->getName()}(加速度:{$acceleration}m/s^2 最高速度:{$car->getVelocityMax()}km/h)\n";
            echo "記録：{$res_list[$i]['time']}秒\n";
            echo "クラッシュ回数：{$res_list[$i]['crush_num']}回\n";
            echo "\n";
        }
    }

    // 途中結果リスト作成
    public function createProgress(){
        // 途中経過のリスト作成
        $res_list = [];
        foreach ($this->result as $car_data){
            $res_list[] = ['name' => $car_data['object']->getName(), '状態' => "ゴール"];
        }
        foreach ($this->car_list as $car_data){
            $res_list[] = ['name' => $car_data['object']->getName(), '状態' => "{$car_data['position']}m"];
        }
        return $res_list;
    }    

    // 途中結果出力
    private function printProgress(){
        // 元の順位
        $origin_list = array_column($this->createProgress(),'name');

        // 並び替え
        $positions = array_column($this->car_list,'position');
        array_multisort($positions, SORT_DESC, $this->car_list);

        // 新しい順位
        $after_list = array_column($this->createProgress(),'name');

        // 現在位置を知るための途中経過のリスト
        $res_list = $this->createProgress();

        foreach($after_list as $after_key => $val){
            $origin_key = array_keys($origin_list, $val)[0];
            $s = $after_key + 1;
            if($after_key < $origin_key){
                echo "↑ {$s}位：{$val} 現在位置{$res_list[$after_key]['状態']}\n";
            }
            elseif($after_key > $origin_key){
                echo "↓ {$s}位：{$val} 現在位置{$res_list[$after_key]['状態']}\n";
            }
            else{
                echo "→ {$s}位：{$val} 現在位置{$res_list[$after_key]['状態']}\n";
            }
        }
        echo "\n";
        $this->sleep_s();
    }

    // コース表示
    private function printCourse($course_object){
        echo "コース概要\n";
        $course_names = [
            'straight' => "ストレート",
            'corner' => "コーナー",
            'before_corner' => "コーナー手前"
        ];
        $course_list = $course_object->getCourse();
        foreach($course_list as $course_data){
            $course = $course_data['course_object'];
            echo "{$course_names[$course->getType()]}:{$course->getDistance()}m";
            // コーナーなら許容速度表示
            if ($course->getType() == "corner"){
                echo "(許容速度:{$course->getAllowableVelocity()}km/s)\n";
            }else{
                echo "\n";
            }
        }
        echo "計：{$this->course_range}m\n";
    }

    // ドライバーの有無判定
    private function isDriver(){
        foreach($this->car_list as $car_data){
            $car_object = $car_data['object'];
            $member     = $car_object->getMember();
            if($member == 0){
                echo "{$car_object->getName()}にドライバーが乗ってません。";
                break;
            }
        }
    }

    // レース開始
    public function gameStart(){
        $this->isDriver();
        $course = new Course($this->course_range, $this->corner_rate);
        $this->printCourse($course);
        $this->sleep_s();

        $delta_time = 0.1;
        echo "\nレーススタート\n";

        $show_interval = 10;
        $object_time = $show_interval;
        // 任意秒数ごとに更新
        for($i = 0 + $delta_time; $i < $this->limit; $i += $delta_time){
            // すべての車の更新
            for($j = 0; $j < count($this->car_list); $j++){
                // 車取得
                $car = &$this->car_list[$j];
                // 道取得
                $road = $course->getRoad($car['position']);
                // 車の操作
                $this->operateCar($car['object'], $delta_time, $road);
                
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
                echo "終了\n";
                $this->printCourse($course);
                $this->printResult();
                break;
            }
            
            $i = round($i,3);
            // 途中経過表示
            if((String)$i == (String)$object_time){
                echo "\n{$i}秒経過\n";
                $this->printProgress();
                $this->sleep_s();
                $object_time += $show_interval;
            }
        }
    }
    // sleep処理を一括でコメントするため
    private function sleep_s(){
        // sleep(1);
    }
}


?>