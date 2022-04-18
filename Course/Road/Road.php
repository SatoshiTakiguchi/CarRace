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

?>