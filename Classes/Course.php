<?php

require 'Road/Straight.php';
require 'Road/Corner.php';

class Course{
    private $course = [];
    private $distance = 0;

    // コース作成
    public function __construct($max_distance = 2000){
        while($this->distance < $max_distance){
            $p = mt_rand(0,100);
            if($p<30){
                $road = new Straight();
            }else{
                $road = new Corner();
            }
            $dist = $road->getDistance();
            if($max_distance < $this->distance + $dist){
                $road->setDistance($max_distance - $this->distance);
                $dist = $road->getDistance();
            }
            $this->distance += $dist;
            $this->course[] = ['course_object' => $road,'distance' => $this->distance];
        }
    }

    // 現在位置からどの道にいるかを返す
    public function getRoad($now_distance){
        for($i = 0; $i < count($this->course); $i++){
            if($now_distance <= $this->course[$i]['distance']){
                return $this->course[$i]['course_object'];
            }
        }
    }

    public function showCourse(){
        print_r($this->course);
    }
}

?>