<?php
require_once 'Cars.php';

class Nissan extends Cars{
    public function __construct($price=null,$member_capacity=5){
        if(!$price){
            $price = mt_rand(50,100);
        }
        parent::__construct("Nissan",$price,$member_capacity,$acceleration=15,160);
        parent::__construct(
            $name = "Nissan",
            $price = $price,
            $member_capacity = $member_capacity,
            $acceleration = 30,
            $velocityMax = 160
        );
        //  Nissanやらかし処理
         echo 
         "Nissanは製造時にやらかしました。\n→ 加速度:60%\n";
         $this->acceleration *= 0.6;
    }
}

?>