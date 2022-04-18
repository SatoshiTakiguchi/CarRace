<?php
require_once 'Cars.php';

class Ferrari extends Cars{
    protected $isLiftUp = false; // 車高
    public function __construct($price=null,$member_capacity=2){
        $this->height = 1050;
        if(!$price){
            $price = mt_rand(900,2000);
        }
        parent::__construct(
            $name = "Ferrari",
            $price = $price,
            $member_capacity = $member_capacity,
            $acceleration = 40,
            $velocityMax = 200
        );
    }

    // 車情報表示
    public function showCarData(){
        parent::showCarData();
        // echo "車種：{$this->name}\n";
        // echo "値段：{$this->price}万円\n";
        // echo "定員：{$this->member_capacity}人\n";
        // echo "乗車人数：{$this->member}人\n";
        // echo "現在速度：{$this->velocity}km/h\n";
        // echo "最高速度{$this->velocityMax}km/h\n";
        // echo "加速度：{$this->acceleration}(km/h)/s\n";
        echo "現在車高：{$this->height}mm\n";
        if($this->isLiftUp){
            echo "状態：リフトアップ中！\n";
        }else{
            echo "状態：リフトアップしてません。\n";
        }
    }

    // 車高変更
    public function heightChange(){
        if($this->isLiftUp){
            echo "//リフトダウン実行\n";
            $this->height -= 40;
            $this->acceleration /= 0.8;
        }else{
            echo "//リフトアップ実行\n";
            $this->height += 40;
            $this->acceleration *= 0.8;
        }
        $this->isLiftUp = !$this->isLiftUp;
    }

    // 車高と加速度表示
    public function Q2(){
        $acceleration = Calc::toKmPerSS($this->acceleration);
        if($this->isLiftUp){
            echo "状態：リフトアップ中！\n";
        }else{
            echo "状態：リフトアップしてません。\n";
        }
        echo "車高：{$this->height}mm\n";
        echo "加速度：{$acceleration}m/s^2\n";
    }
}

?>