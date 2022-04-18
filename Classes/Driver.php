<?php


// 後の拡張性のために作ったクラス
class Driver{

    // ブレーキの踏み具合
    // とりあえずクラス関数として定義
    // 単位（km/h/s）
    public static function brakeStrength(){
        return mt_rand(10,40);
    }

}

?>