<?php

class Calc{

    // 車リストから統計出力
    public static function printStatistics($car_list){
        // 合計金額
        $sum_price = array_sum(array_column($car_list,'price'));
        // 合計台数
        $sum_cars = count($car_list);
        // 平均金額
        $ave_price = round($sum_price / $sum_cars);
        echo 
        "
        合計台数：{$sum_cars}台
        合計金額：{$sum_price}万円
        平均金額：{$ave_price}万円
        ";   
    }

    // 時速と経過秒から移動距離算出
    public static function move($velocity,$time){
        return round($velocity * 1000 / (60*60) * $time);
    }

    public static function toKmPerSS($acceleration){
        return round($acceleration * 1000 / (60*60),1);
    }


}


?>