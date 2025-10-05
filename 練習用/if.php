<?php

// if文
// if (条件式) {
//     条件式が真の場合に処理を実行！   
// }
$age = 31;
if ($age > 30) {
    echo 'ゆきひろは30歳より年上<br>';
}

// 条件式が false = 偽 になる条件
// 0, 空文字"", 空の配列[], null（データなし）, メンバ変数の数が0のオブジェクト
// 上記以外はtrue
$num = "";
if ($num) {
    echo 'trueです！<br>';
}

// 比較演算子
$year = 2022;
if ($year === 2022) {
    echo '今年は2022年です！<br>';
}

// 論理演算子
$education = "高学歴";
$income = "低収入";
if ($education === "高学歴" && $income === "高収入") {
    echo 'この人と結婚したい！<br>';
}


// if..else..文
// if (条件式) {
//     条件式が真の場合に処理を実行！
// } else {
//     条件式が偽の場合に処理を実行！
// }
$age = 31;
if ($age >= 30) {
    echo 'ゆきひろは30歳以上<br>';
} else {
    echo 'ゆきひろは30歳より年下<br>';
}

// if..else if..else..文 
// if (条件式1) {
//     条件式1が真の場合に処理を実行！
// } else if (条件式2) {
//     条件式2が真の場合に処理を実行！
// } else {
//     条件式がすべて偽の場合に処理を実行！
// }
$education = "高学歴";
$income = "低収入";
$height = "高身長";
if ($education === "高学歴") {
    echo '高学歴のこの人と結婚したい！<br>';
} else if ($income === "高収入") {
    echo '高収入のこの人と結婚したい！<br>';
} else if ($height === "高身長") {
    echo '高身長のこの人と結婚したい！<br>';
} else {
    echo 'この人と結婚しない！<br>';
}


// switch文
$area = "ロンドン";
switch ($area) {
    case 'ロンドン':
        echo "国はイギリスです<br>";
        // breakを書かないとロンドンの場合は次のcaseの内容も実行される！
        break;
    case 'カリフォルニア':
        echo "国はアメリカです<br>";
        break;
    case '東京':
        echo "国は日本です<br>";
        break;
    default:
        echo "国がわかりません<br>";
}
// if.. else if .. 文 よりも見通しがよくスッキリする！

// （例題）
// 3種類のPC（MacBook, iMac, IdeaPad）から、PC１つを選んで買うかどうか判断する
// 第1希望：20万円以下の価格で、MacBookもしくはiMacなら"（PC名）を買います"と表示させる
// 第2希望：10万円以下の価格なら、"（PC名）を買います"と表示させる
// 第3希望：第1,第2どれにも当てはまらない場合は、"（PC名）を買いません"と表示させる
// 下記のように、PCの種類は「$pc」価格は「$price」という変数に入れて条件分岐を作ることとする
$pc = "MacBook";
$price = 190000;
if ($pc !== "IdeaPad" && $price <= 200000) {
    echo $pc. "を買います";
} else if ($price <= 100000) {
    echo $pc. "を買います";
} else {
    echo $pc. "を買いません";
}
