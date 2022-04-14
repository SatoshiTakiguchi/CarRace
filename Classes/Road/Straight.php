<?php

require_once 'Road.php';

class Straight extends Road{
    public function __construct(){
        $this->type = "straight";
        $this->allowable_velocity = null;
        $this->distance = mt_rand(300,800);
    }
}

?>