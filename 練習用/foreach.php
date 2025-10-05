<?php
// foreach文
// foreach ($配列の変数 as $変数) {
//      実行内容;
// }
$friendsList = ["ジェシー", "ミシェル", "ステファニー"];
foreach ($friendsList as $friend) {
    echo $friend. "<br>";
}

// foreachでキーを利用する
// foreach ($配列の変数 as $キーの変数 => $変数) {
//      実行内容;
// }
$friendsList = [
    "jesse" => "ジェシー",
    "michelle" => "ミシェル",
    "stephanie" => "ステファニー",
];
foreach ($friendsList as $key => $friend) {
    if ($key === 0) {
        echo $friend. "と買い物に行きます！<br>";
    }
}

// foreach文で配列の各要素の値を変える
$fruitsList = [
    "apple" => 100,
    "banana" => 40,
    "orange" => 30,
];
foreach ($fruitsList as &$fruit) {
    $fruit = $fruit * 0.9;
}
echo print_r($fruitsList). "<br>";
foreach ($fruitsList as $key => $fruit) {
    $fruitsList[$key] *= 0.9;
}
echo print_r($fruitsList). "<br>";

// foreach文 繰り返しの中で繰り返し
// 3次元配列
$engineersList = [
    "overseas" => [
        ["マーク", 37],
        ["スティーブ", 56],
        ["イーロン", 50],
    ],
    "japanese" => [
        ["ゆきひろ", 33],
        ["じゅんいち", 44],
        ["いさむ", 41],
    ],
];
foreach ($engineersList as $engineersKind) {
    foreach ($engineersKind as $engineers) {
        echo $engineers[0]. "は". $engineers[1]. "歳です<br>";
    }
}