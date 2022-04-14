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
    public function getName(){
        return $this->name;
    }
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
        echo "加速度{$this->acceleration}(km/h)/s\n";
    }
}

?>