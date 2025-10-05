<?php

// 変数とは
$name = "ゆきひろ";
$age = 30;
echo $name. "<br>";
echo $age. "<br>";

// データ型
echo $name. "【データ型】". gettype($name). "<br>";
echo $age. "【データ型】". gettype($age). "<br>";
echo true. "【データ型】". gettype(true). "<br>";

// 代入演算子
$num = 5 * 3;
echo $num. "<br>";
// $num = $num + 9;
$num += 9;
echo $num. "<br>";
// $num += 1;
$num++;
echo $num. "<br>";

?>

<!-- HTMLタグ中に表示 -->
<h1><?php echo $name; ?></h1>
<h1><?=$name?></h1>
