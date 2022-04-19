<?php
require_once 'Cars.php';

class Honda extends Cars{
    public function __construct(
        $price        = null, 
        $acceleration = 30, 
        $velocityMax  = 160
    ){
        if(!$price){
            $price = mt_rand(100,300);
        }
        parent::__construct(
            $name            = "Honda",
            $price           = $price,
            $member_capacity = 8,
            $acceleration    = $acceleration,
            $velocityMax     = $velocityMax
        );
    }
}

?>