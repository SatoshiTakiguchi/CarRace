<?php
require_once 'Cars.php';

class Toyota extends Cars{
    public function __construct($price=null,$member_capacity=8){
        if(!$price){
            $price = mt_rand(200,400);
        }
        parent::__construct("Toyota",$price,$member_capacity,$acceleration=15,170);
        parent::__construct(
            $name = "Toyota",
            $price = $price,
            $member_capacity = $member_capacity,
            $acceleration = 30,
            $velocityMax = 170
        );
        $this->acceleration += $this->price * 0.01;
    }
}

?>