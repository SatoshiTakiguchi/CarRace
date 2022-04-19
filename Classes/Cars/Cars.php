<?php
require_once 'Classes/Calc.php';

abstract class Cars{
    protected String $name;
    protected int    $price;           // 万円
    protected int    $member;
    protected int    $member_capacity;
    protected float  $velocity = 0;    // km/h
    protected float  $velocityMax;     // km/h
    protected int    $height;          // mm
    protected float  $acceleration;    //km/hs

    // 車のランダム数生成
    public static function randomCreate($class,$min_range=1,$max_range=20){
        $res_list = [];
        $num = mt_rand($min_range,$max_range);
        for($i = 0; $i < $num; $i++){
            $res_list[] = new $class();
        }
        return $res_list;
    }  

    protected function __construct(
        $name="名前がありません",
        $price,
        $member_capacity,
        $acceleration,
        $velocityMax
        )
    {
        $this->name = $name;
        $this->member_capacity = $member_capacity;
        $this->acceleration = $acceleration;
        $this->price = $price;
        $this->velocityMax = $velocityMax;
    }

    // array_columnのため
    public function __get($prop){
        return $this->$prop;
    }
    public function __isset($prop):bool{
        return isset($this->$prop);      
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
    public function getHeight(){
        return $this->height;
    }
    public function getAcceleration(){
        return $this->acceleration;
    }
    public function getMember(){
        return $this->member;
    }
    public function getVelocityMax(){
        return $this->velocityMax;
    }

    // 速度代入
    public function setVelocity($velocity){
        $this->velocity = $velocity;
    }

    // 加速
    public function velocityUp($time){
        $this->velocity += $this->acceleration * $time;
        if($this->velocityMax < $this->velocity){
            $this->velocity = $this->velocityMax;
        }
    }

    // 減速
    public function velocityDown($time, $num){
        $this->velocity -= $num * $time;
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
        $acceleration = Calc::toKmPerSS($this->acceleration);
        echo "車種：{$this->name}\n";
        echo "値段：{$this->getPrice()}万円\n";
        echo "定員：{$this->member_capacity}人\n";
        echo "乗車人数：{$this->member}人\n";
        echo "現在速度：{$this->velocity}km/h\n";
        echo "最高速度：{$this->velocityMax}km/h\n";
        echo "加速度：{$acceleration}m/s^2\n";
    }

    // 人数と加速度表示
    public function Q4(){
        $acceleration = Calc::toKmPerSS($this->acceleration);
        echo "定員：{$this->member_capacity}人\n";
        echo "乗車人数：{$this->member}人\n";
        echo "加速度：{$acceleration}m/s^2\n";
    }
}

?>