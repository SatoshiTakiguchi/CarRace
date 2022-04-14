<?php

require 'Road.php';

class Course{
    private $course = [];
    private $distance = 0;

    // コース作成
    public function __construct($max_distance = 2000){
        while($this->distance < $max_distance){
            $straight = new Straight();
            $dist = $straight->getDistance();
            if($max_distance < $this->distance + $dist){
                $straight->setDistance($max_distance - $this->distance);
                $dist = $straight->getDistance();
            }
            $this->distance += $dist;
            $this->course[] = ['course_object' => $straight,'distance' => $dist];
        }
    }

    // 現在位置からどの道にいるかを返す
    public function getRoad($now_distance){
        for($i = 0; $i < count($this->course); $i){
            if($now_distance < $this->course[$i]['distance']){
                return $this->course[$i]['course_object'];
            }
        }
    }
}

?>