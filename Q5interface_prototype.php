<?php

/* 

仕様

コース
    ストレート
    コーナー //順位変動要素
        許容速度
            オーバーしたら現在速度->"速度"になる(10km/hとか)
            時間ロス（一定時間加速なし、減速など）

ちょうどよい速度：それぞれ値を決める（最高速度の3/4とか）

アクセルを踏むときとその確率
    ちょうどよい速度より小さいほど確率が上がる
    (できればちょうどよい速度より大きくても踏むようにする)


ブレーキを踏むときとその確率
    ちょうどよい速度より大きいほど確率が上がる
    (できればちょうどよい速度より小さくても踏むようにする)
    ブレーキを踏む時間は指定しない。

sleep(int);
時間遅延できる

*/

// 途中経過の知らせ方、表示項目
echo "レース開始\n";
sleep(1);

echo
"
任意時間ごとに順位表示
";
sleep(1);
echo "1位:\n";
sleep(1);
echo "2位:\n";
sleep(1);
echo "3位:\n";
sleep(1);
echo "4位:\n";

sleep(1);
echo "(任意距離突破時)\n";
sleep(1);
echo "(”名前”は”距離”mを突破)";
sleep(1);
echo
"
”名前”はコーナーを曲がる！
クラッシュしたらその状況を知らせる
”名前”はコーナーを曲がり切った！
";
sleep(1);
echo
"
レース終了
優勝：”名前”　秒数
";

?>