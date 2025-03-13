<?php
namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;
use App\Enums\City;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function index(Request $request)
    {
        $cityName = $request->input('city', 'Tokyo');

        // City クラスの getCoordinates() を使って緯度・経度を取得
        $cityLocation = City::getCoordinates($cityName);
        
        if (!$cityLocation) {
            return response()->json(['error' => 'Invalid City Name'], 400);
        }

        try {
            $weatherDate = $this->weatherService->fetchWeatherDate($cityLocation['latitude'], $cityLocation['longitude']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // 全都市情報を取得
        $cities = City::getAllCities();

        return view('weather.index', [
            'city' => $cityName, 
            'cities' => $cities, 
            'weatherDate' => $weatherDate
        ]);
    }
}




// class WeatherController extends Controller
// {
//     protected $weatherService;

//     public function __construct(WeatherService $weatherService)
//     {
//         $this->weatherService = $weatherService;
//     }

//     public function index(Request $request)
//     {
//         $cityName = $request->input('city', 'Tokyo');

//         try {
//             $city = City::from($cityName);
//         } catch (\Exception $e) {
//             return response()->json(['error' => 'Invalid City Name'], 400);
//         }
//         $cityLocation = $city->getCoordinates();

//         try {
//             $weatherDate = $this->weatherService->fetchWeatherDate($cityLocation['latitude'], $cityLocation['longitude']);
//             } catch (\Exception $e) {
//                 return response()->json(['error' => $e->getMessage()], 500);
//             }
//             $cities = City::getAllCities();
//             return view('weather.index', ['city' => $city, 'cities' => $cities, 'weatherDate' => $weatherDate]);
//     }
// }
