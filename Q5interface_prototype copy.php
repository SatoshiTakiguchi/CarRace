<?php

/* 

仕様

コースの長さ（ゴール地点）
↑これでコースを表す
カーブとかの区別はしない

結果の表示
　全員の順位

ブレーキ
　常に確率
　適当に10%とか5%くらい

---↑ここまでが最低限ラインとした---

任意秒数ごとに途中結果の表示
　それぞれ何ｍ地点にいるか

アクセルも確率にして何もしない場合を設けてもよい

sleep(int);
時間遅延できる


Field.php(人によってはcourse.php)


mainQ5
$field = new Field()

$honda = new Honda()
.
.

$field->addCar($honda)
.
.

$field->start()


Field.php
class Field{
    private $car_list = []


}

*/

// 途中経過の知らせ方、表示項目
echo "レース開始\n";
sleep(1);

echo
"
任意時間ごとに状況
";
sleep(1);
echo "名前:”名前”　距離：”距離”\n";
sleep(1);
echo "名前:”名前”　距離：”距離”\n";
sleep(1);
echo "名前:”名前”　距離：”距離”\n";
sleep(1);
echo "名前:”名前”　距離：”距離”\n";

sleep(1);
echo
"
レース終了
優勝：”名前”　(できれば秒数も)
できればそれぞれの順位
";

?>