<?php

class Fields{
    private $car_list = [];
    private int $minutes = 4;

    public function gameStart(){
        
        for($i = 0; $i < $this->minutes; $i++){
            print($i);
        }
    }
}


?>