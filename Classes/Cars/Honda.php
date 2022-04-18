<?php
require_once 'Cars.php';

class Honda extends Cars{
    public function __construct($price=null,$member_capacity=8){
        if(!$price){
            $price = mt_rand(100,300);
        }
        parent::__construct(
            $name = "Honda",
            $price = $price,
            $member_capacity = $member_capacity,
            $acceleration = 30,
            $velocityMax = 160
        );
    }
}

?>