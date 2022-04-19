<?php

require 'Road/Straight.php';
require 'Road/Corner.php';
require 'Road/BeforeCorner.php';

class Course{
    private $course = []; // ['course_object' => 道, 'distance' => その道の終了位置]
    private $course_range;
    // コース作成
    public function __construct(
        $course_range = 2000, 
        $corner_rate_percent = 25,
    ){
        $this->course_range = $course_range;
        $distance = 0;
        while($distance < $this->course_range){
            // straight か cornerか
            $p = mt_rand(1,100);
            if($corner_rate_percent < $p){
                $road = new Straight();
            }else{
                $road = new Corner();
            }

            // 道の長さ
            $dist = $road->getDistance();

            // 全長を超えた時の処理
            if($this->course_range < $distance + $dist){
                $road->setDistance($this->course_range - $distance);
                $dist = $road->getDistance();
            }

            $distance += $dist;

            // 道の追加
            if($road->getType() == "corner"){
                // コーナー手前距離設定
                $befor_coner_dist = 30;

                // コーナー距離修正
                $road->setDistance($road->getDistance() - $befor_coner_dist);

                // コーナー手前作成
                $befor_coner = new BeforeCorner($befor_coner_dist);
                // 道の追加
                $this->addRoad($befor_coner, $distance-30);
                $this->addRoad($road, $distance);
            }
            else{
                $this->addRoad($road, $distance);
            }
        }
    }
    // コースに道追加
    private function addRoad($road, $distance){
        $this->course[] = ['course_object' => $road,'distance' => $distance];
    }

    // コースリスト取得
    public function getCourse(){
        return $this->course;
    }
    public function getCourseRange(){
        return $this->course_range;
    }

    // 現在位置からどの道にいるかを返す
    public function getRoad($now_distance){
        for($i = 0; $i < count($this->course); $i++){
            if($now_distance <= $this->course[$i]['distance']){
                return $this->course[$i]['course_object'];
            }
        }
    }
}

?>