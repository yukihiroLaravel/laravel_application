<?php

namespace App\Services;
use GuzzleHttp\Client;

class WeatherService
{
  public function fetchWeatherDate($latitude, $longitude)
  {
    $client = new Client();
        $response = $client->get('https://api.open-meteo.com/v1/forecast', [
            'query' => [
                'latitude' => $latitude,
                'longitude' => $longitude,
                'current' => 'temperature_2m,wind_speed_10m',
                'hourly' => 'temperature_2m',
                'timezone' => 'Asia/Tokyo',
            ]
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Failed to fetch weather date');
        }

        return json_decode($response->getBody(), true);
  }
}