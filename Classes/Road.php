<?php

abstract class Road{
    protected $type;
    protected $distance;
    protected $allowable_velocity;

    // 各データ取得関数
    public function getType(){
        return $this->type;
    }
    public function getDistance(){
        return $this->distance;
    }
    public function getAllowableVelocity(){
        return $this->allowable_velocity;
    }

    public function setDistance($distance){
        $this->distance = $distance;
    }
}

class Straight extends Road{
    public function __construct(){
        $this->type = "straight";
        $this->allowable_velocity = null;
        $this->distance = mt_rand(300,800);
    }
}

class Corner extends Road{
    public function __construct(){
        $this->type = "corner";
        $this->allowable_velocity = mt_rand(70,120);
        $this->distance = mt_rand(100,200);
    }
}

?>