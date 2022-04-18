<?php

require_once 'Road.php';

class BeforeCorner extends Road{
    public function __construct($distance = 30){
        $this->type = "before_corner";
        $this->allowable_velocity = INF;
        $this->distance = $distance;
    }
}

?>