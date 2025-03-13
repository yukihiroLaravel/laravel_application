<?php
namespace App\Enums;

class City
{
    public const Tokyo = 'Tokyo';
    public const Osaka = 'Osaka';
    public const Nagoya = 'Nagoya';
    public const Sapporo = 'Sapporo';
    public const Fukuoka = 'Fukuoka';
    public const Naha = 'Naha';

    public static function getCoordinates(string $city): ?array
    {
        $locations = [
            self::Tokyo => ['latitude' => 35.682839, 'longitude' => 139.759455],
            self::Osaka => ['latitude' => 34.693737, 'longitude' => 135.502165],
            self::Sapporo => ['latitude' => 43.062096, 'longitude' => 141.354376],
            self::Fukuoka => ['latitude' => 33.590354, 'longitude' => 130.401716],
            self::Nagoya => ['latitude' => 35.181472, 'longitude' => 136.906586],
            self::Naha => ['latitude' => 26.212401, 'longitude' => 127.6833],
        ];

        return $locations[$city] ?? null;
    }

    public static function getKanjiName(string $city): ?string
    {
        switch ($city) {
            case self::Tokyo: return '東京';
            case self::Osaka: return '大阪';
            case self::Sapporo: return '札幌';
            case self::Fukuoka: return '福岡';
            case self::Nagoya: return '名古屋';
            case self::Naha: return '那覇';
            default: return null;
        }
    }

    public static function getAllCities(): array
    {
        return [
            ['english_name' => self::Tokyo, 'kanji_name' => self::getKanjiName(self::Tokyo)],
            ['english_name' => self::Osaka, 'kanji_name' => self::getKanjiName(self::Osaka)],
            ['english_name' => self::Sapporo, 'kanji_name' => self::getKanjiName(self::Sapporo)],
            ['english_name' => self::Fukuoka, 'kanji_name' => self::getKanjiName(self::Fukuoka)],
            ['english_name' => self::Nagoya, 'kanji_name' => self::getKanjiName(self::Nagoya)],
            ['english_name' => self::Naha, 'kanji_name' => self::getKanjiName(self::Naha)],
        ];
    }
}



// enum City: string {
//     case Tokyo = 'Tokyo';
//     case Osaka = 'Osaka';
//     case Nagoya = 'Nagoya';
//     case Sapporo = 'Sapporo';
//     case Fukuoka = 'Fukuoka';
//     case Naha = 'Naha';
  
//     public function getCoordinates(): array
//     {
//       return match($this) {
//         self::Tokyo => ['latitude' => 35.682839, 'longitude' => 139.759455],
//         self::Osaka => ['latitude' => 34.693737, 'longitude' => 135.502165],
//         self::Sapporo => ['latitude' => 43.062096, 'longitude' => 141.354376],
//         self::Fukuoka => ['latitude' => 33.590354, 'longitude' => 130.401716],
//         self::Nagoya => ['latitude' => 35.181472, 'longitude' => 136.906586],
//         self::Naha => ['latitude' => 26.212401, 'longitude' => 127.6833],
//       };
//     }
  
//   }