<?php

require_once 'Road.php';

class Corner extends Road{
    public function __construct(){
        $this->type = "corner";
        $this->allowable_velocity = mt_rand(70,120);
        $this->distance = mt_rand(100,200);
    }
}

?>