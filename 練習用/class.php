<?php

// クラスの定義方法
// class クラス名 {
//     実行内容
// }

class Character
{
    // メンバ変数
    // public
    // private
    // protected
    // ヒットポイント（HP）
    public $hitPoint;

    private function parupunte () {
        // 何が起きるかわからない
    }

    public function __construct () {
        $this->hitPoint = 30;
        echo "初期HPは". $this->hitPoint. "です！<br>";
    }

    // メンバメソッド
    // たたかう
    function hit ($point) {
        echo "攻撃した！モンスターに". $point. "のダメージ！<br>";
    }

    // にげる
    function runAway () {
        echo "逃げた！<br>";
    }

    // モンスターからの攻撃でHPが減る
    public function attacked ($point) {
        $this->damaged($point);
        $this->hitPoint -= $point;
        echo "残りHPは". $this->$hitPoint. "です...<br>";
    }

    // モンスターからダメージ
    private function damaged ($point) {
        echo "モンスターからの攻撃を受けた！<br>";
        echo $point. "のダメージ！<br>";
    }
}

// クラスの親子関係
class Wizard extends Character
{
    // じゅもん
    public function magic () {
        echo "魔法を唱えた！<br>";
        $this->hit(8);
    }
}

// クラスをオブジェクト化して使う（動的）
// $オブジェクト名 = new クラス名(引数)
// $オブジェクト名->メンバ変数 = 20;
// $オブジェクト名->メンバメソッド();
$hero = new Character();
$hero->hitPoint = 20;
print_r($hero);
echo "<br>";
// $hero->hit();

// クラスのまま使う（静的）
// クラス名::メンバメソッド();
// Character::hit();

// メンバメソッドの引数
$hero->hit(5);

// コンストラクタ

// アクセス修飾子
$hero->attacked(4);

// クラスの親子関係
$wizard = new Wizard();
$wizard->magic();
$wizard->attacked(7);