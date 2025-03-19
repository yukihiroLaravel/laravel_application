<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class News extends Model
{
    //ニュースの取得
    public static function fetchNews($keyword=null)
    {
        $client = new Client();
        $url = 'https://newsapi.org/v2/top-headlines?country=us&pageSize=10&apiKey=' . config('services.newsapi.key');

        //キーワードがある場合はキーワードを含むニュースを取得
        if($keyword) {
            $url .= '&q=' . urlencode($keyword);
        }

        try {
            $response = $client->request('GET', $url);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            throw new \Exception('failed to fetch news data: ' . $e->getMessage());
        }

        //Laravel6で使用できなかった
        //$response = Http::get($url);
        // if($response->failed()) {
        //     throw new \Exception('failed to fetch news date');
        // }   
        //return $response->json();
    }

    public static function summarizeArticle($content)
    {
        $client2 = new Client();
        $apiKey = config('services.openai.key');

        $systemRole = 'あなたは優秀なWEBライターです';
        $prompt = '以下の記事を100文字程度で要約してください。#記事\n' . $content;
        try {
            $response2 = $client2->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $apiKey,
                ],
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'system', 'content' => $systemRole],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'max_tokens' => 300,
                    'temperature' => 0.7,
                ],
            ]);
        $response2 = json_decode($response2->getBody()->getContents(), true);
        $summarizedContent = $response2['choices'][0]['message']['content'];

        return response()->json(['summarizedContent' => $summarizedContent]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

}