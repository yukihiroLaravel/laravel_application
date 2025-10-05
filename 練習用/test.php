<?php
//foreach文の例文
// $array2 = array();  
// $array2["a"] = 1;
// $array2["b"] = 12;
// $array2["c"] = 123;
// foreach ($array2 as $key => $value) {
//     echo "添字:". $key. ",要素:". $value. "\n";
// }

//for文かつ途中で止める場合
// for ($i = 0; $i < 5; $i++) {   
//     if ($i === 2) {
//         echo "終了"."\n";        
//         break;
//     }
//     echo 1;
//     echo "\n";
// }

//返り値の取得 bool型
// var_dump(toggle(true));

// function toggle($flg)
// {
//     return !$flg;
// }

// $names = ["田中", "佐藤", "佐々木", "高橋", ];

// $array1 = ["dog", "cat", "fish"];
// $array2 = ["bird", "bat", "tiger"];

// $numbers = [1, 5, 8, 10, 2, 3, 2, 3, 1, 4, 5, 9];

$result = 0;

while(true) {
    echo "数字を入力してください\n";
    $num = trim(fgets(STDIN));
    $result += $num;
    echo "合計: " . $result . "\n";
}