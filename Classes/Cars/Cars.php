<?php

class Cars{
    protected String $name;
    protected int $price =-1;
    protected int $member = 0;
    protected int $member_capacity = -1;
    protected float $velocity = 0;
    protected float $velocityMax = -1;
    protected int $height = -1;
    protected float $acceleration = -1;

    // データ入力
    protected function initialize($name="名前がありません",$price,$member_capacity,$acceleration,$velocityMax){
        $this->name = $name;
        $this->member_capacity = $member_capacity;
        $this->acceleration = $acceleration;
        $this->price = $price;
        $this->velocityMax = $velocityMax;
    }

    // データ取得
    public function getPrice(){
        return $this->price;
    }
    public function getVelocity(){
        return $this->velocity;
    }

    // 加速
    public function velocityUp($time){
        $this->velocity += $this->acceleration * $time;
        if($this->velocityMax < $this->velocity){
            $this->velocity = $this->velocityMax;
        }
    }

    // 減速
    public function velocityDown($time){
        $this->velocity -= $this->acceleration * $time;;
    }

    // 乗車
    public function memberCountUp(){
        if($this->member_capacity == $this->member){
            echo "もう乗れません。\n";
            return;
        }
        $this->acceleration /= (1 - $this->member*0.05);
        $this->member += 1;
        $this->acceleration *= (1 - $this->member*0.05);
    }

    // 降車
    public function memberCountDown(){
        if($this->member < 1){
            echo "誰も乗ってません。\n";
            return;
        }
        $this->acceleration /= (1 - $this->member*0.05);
        $this->member -= 1;
        $this->acceleration *= (1 - $this->member*0.05);
    }

    // 車情報表示
    public function showCarData(){
        echo "車種：{$this->name}\n";
        echo "値段：{$this->getPrice()}万円\n";
        echo "定員{$this->member_capacity}人\n";
        echo "乗車人数{$this->member}人\n";
        echo "現在速度{$this->velocity}km/h\n";
        echo "最高速度{$this->velocityMax}km/h\n";
        echo "現在加速度{$this->acceleration}(km/h)/s\n";
    }
}

class Honda extends Cars{
    public function __construct($price=null,$member_capacity=8){
        if(!$price){
            $price = mt_rand(100,300);
        }
        $this->initialize("Honda",$price,$member_capacity,$acceleration=10,120);
    }
}

class Nissan extends Cars{
    public function __construct($price=null,$member_capacity=5){
        if(!$price){
            $price = mt_rand(50,100);
        }
        $this->initialize("Nissan",$price,$member_capacity,$acceleration=20,160);
        //  Nissanやらかし処理
         echo 
         "Nissanは製造時にやらかしました。
         {$this->acceleration}(km/h)/s
         ↓ 加速度60%減
         ";
         $this->acceleration *= 0.6;
         echo 
         "{$this->acceleration}(km/h)/s\n";
    }
}

class Ferrari extends Cars{
    protected $height_change = false; // 車高
    public function __construct($price=null,$member_capacity=2){
        $this->height = 1050;
        if(!$price){
            $price = mt_rand(900,2000);
        }
        $this->initialize("Ferrari",$price,$member_capacity,$acceleration=30,200);
    }

    // 車情報表示
    public function showCarData(){
        echo "車種：{$this->name}\n";
        echo "値段：{$this->price}万円\n";
        echo "定員：{$this->member_capacity}人\n";
        echo "乗車人数：{$this->member}人\n";
        echo "現在速度：{$this->velocity}km/h\n";
        echo "現在加速度：{$this->acceleration}(km/h)/s\n";
        echo "現在車高：{$this->height}mm\n";
        if($this->height_change){
            echo "リフトアップ中！";
        }
    }

    // 車高変更
    public function heightChange(){
        if($this->height_change){
            echo "リフトダウン実行";
            $this->height -= 40;
            $this->acceleration /= 0.8;
        }else{
            echo "リフトアップ実行";
            $this->height += 40;
            $this->acceleration *= 0.8;
        }
        $this->height_change = !$this->height_change;
    }
}

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