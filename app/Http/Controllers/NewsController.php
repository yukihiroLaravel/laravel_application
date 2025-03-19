<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $articles = [];
        $keyword = $request->input('keyword');
        $articles = News::fetchNews($keyword);

        $summarizeArticles = [];

        if ($articles && isset($articles['articles'])) {
            foreach ($articles['articles'] as $article) {
                $jsonSummarizeArticle = News::summarizeArticle($article['description']);
                $content = json_decode($jsonSummarizeArticle->getContent(), true);

                if (is_array($content) && isset($content['summarizedContent'])) {
                    $summary = $content['summarizedContent'];
                } else {
                    $summary = '概要なし';
                }

                $summarizeArticles[] = [
                    'title' => $article['title'],
                    'summary' => $summary,
                    'url' => $article['url'],
                ];
            }
        }

        return view('news.index', ['articles' => $summarizeArticles]);
    }
}
