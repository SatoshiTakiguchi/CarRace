<?php
require_once 'Cars.php';

class Honda extends Cars{
    public function __construct($price=null,$member_capacity=8){
        if(!$price){
            $price = mt_rand(100,300);
        }
        $this->initialize("Honda",$price,$member_capacity,$acceleration=10,120);
    }
}

?>