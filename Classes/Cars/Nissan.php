<?php
require_once 'Cars.php';

class Nissan extends Cars{
    public function __construct(
        $price        = null, 
        $acceleration = 30, 
        $velocityMax  = 160
    ){
        if(!$price){
            $price = mt_rand(50,100);
        }
        parent::__construct(
            $name            = "Nissan",
            $price           = $price,
            $member_capacity = 6,
            $acceleration    = $acceleration,
            $velocityMax     = $velocityMax
        );
        //  Nissanやらかし処理
        //  echo 
        //  "Nissanは製造時にやらかしました。\n→ 加速度:60%\n";
         $this->acceleration *= 0.6;
    }
}

?>