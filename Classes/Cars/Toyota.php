<?php
require_once 'Cars.php';

class Toyota extends Cars{
    public function __construct($price=null, $acceleration=30, $velocityMax=170){
        if(!$price){
            $price = mt_rand(200,400);
        }
        parent::__construct(
            $name = "Toyota",
            $price = $price,
            $member_capacity = 8,
            $acceleration = $acceleration,
            $velocityMax = $velocityMax
        );
        $this->acceleration += $this->price * 0.01;
    }
}

?>