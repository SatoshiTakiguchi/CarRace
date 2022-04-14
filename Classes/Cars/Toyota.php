<?php
require_once 'Cars.php';

class Toyota extends Cars{
    public function __construct($price=null,$member_capacity=8){
        if(!$price){
            $price = mt_rand(200,400);
        }
        $this->initialize("Toyota",$price,$member_capacity,$acceleration=20,170);
        $this->acceleration += $this->price * 0.01;
    }
}

?>