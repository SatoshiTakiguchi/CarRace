<?php
require_once 'Cars.php';

class Nissan extends Cars{
    public function __construct($price=null,$member_capacity=5){
        if(!$price){
            $price = mt_rand(50,100);
        }
        parent::__construct("Nissan",$price,$member_capacity,$acceleration=15,160);
        //  Nissanやらかし処理
         echo 
         "Nissanは製造時にやらかしました。
         {$this->acceleration}(km/h)/s
         ↓ 加速度:60%
         ";
         $this->acceleration *= 0.6;
         echo 
         "{$this->acceleration}(km/h)/s\n";
    }
}

?>