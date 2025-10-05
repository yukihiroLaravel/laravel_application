<?php
// 配列とは?
$height_1 = 162;
$height_2 = 171;
$height_3 = 178;

echo $height_1. "<br>". $height_2. "<br>". $height_3. "<br>";

// 生徒が1万人いたら、1万個の変数が必要となってしまう!
$height[0] = 162;
$height[1] = 171;
$height[2] = 178;

// echo $height[0]. "<br>". $height[1]. "<br>". $height[2]. "<br>";

foreach ($height as $value) {
    echo $value. "<br>";
}

// 配列へ格納する
// $配列の変数名[キー] = 値;
$height[0] = 162;

// 配列から値を取得する
// $配列の変数名[キー]
echo $height[0]. "<br>";

// デバッグ時など、配列全体を表示させる
echo print_r($height). "<br>";
echo var_dump($height). "<br>";

// 配列のキー:整数と文字列が使える
// 整数:連続していなくてもOK
$age[0] = 20;
$age[3] = 33;
echo print_r($age). "<br>";

// 文字列:連想配列
$score['math'] = "算数";
$score['english'] = "英語";
echo print_r($score). "<br>";

// 変数を使ってキーを示す
$intKey = 5;
$age[$intKey] = 40;
echo print_r($age). "<br>";

$strKey = "science";
$score[$strKey] = "理科";
echo print_r($score). "<br>";

// キーの自動割り当て
$sport[] = "baseball";
$sport[] = "soccer";
echo print_r($sport). "<br>";

// 既に整数キーの割り当てがある場合は、最大キー+1が割り当てられる
$age[] = 55;
echo print_r($age). "<br>";

// 文字列のキーのみ存在する場合は、整数キーは0から割り当てられる
// 配列を初期化する
$friends = array();
// 新しい書き方かつ、JSなど他の言語でも同様に書くので原則こちらを使おう
$friends = [];
echo print_r($friends). "<br>";

// 値を直接入れて初期化
$pc = ["MacBook", "iMac", "IdeaPad"];
echo print_r($pc). "<br>";

// キーと値を直接入れて初期化
$friends = [
    'jesse' => "ジェシー",
    'michelle' => "ミシェル",
    'stephanie' => "ステファニー",
];
echo print_r($friends). "<br>";
echo $friends['michelle']. "<br>";
// 多次元配列
$engineer_1 = [
    "mark", "steve", "elon",
];
$engineer_2 = [
    "ゆきひろ", "じゅんいち", "いさむ",
];
$engineers = [
    // "engineer_1" => $engineer_1, $engineer_2,
    $engineer_1, $engineer_2,
];
?>

<pre><?php echo print_r($engineers). "<br>"; ?></pre>

<?php

echo $engineers[0][2]. "<br>";

echo $engineers[1][0]. "<br>";


// (例題)理解度チェックテスト
// 次のエンジニアたちの名前と年齢の値が入った
// 2次元配列(連想配列)を1つ作って、その配列の中身をすべて表示させて下さい。
// 1名前:mark 年齢:37歳
// 2名前:steve 年齢:56歳
// 3名前:elon 年齢:50歳

$engineer = [
    ["name" => "mark", "age" => 37],
    ["name" => "steve", "age" => 56],
    ["name" => "elon", "age" => 50],
];
$mark = ["name" => "mark", "age" => 37];
$steve = ["name" => "steve", "age" => 56];
$elon = ["name" => "elon", "age" => 50];
// $engineer = [$mark, $steve, $elon];

?>
<pre><?php echo print_r($engineer). "<br>"; ?></pre>