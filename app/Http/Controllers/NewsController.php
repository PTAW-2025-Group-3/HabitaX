<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    public function index()
    {
        return view('pages.news.index', ['noticias' => $this->getNews()]);
    }

    public function getNews()
    {
        try {
            return Cache::remember('noticias_feed', 3600, function () {
                $response = Http::get('https://rss.app/feeds/v1.1/oo67lwym5zAVNg65.json');
                if ($response->successful()) {
                    return $response->json();
                }
                return ['items' => []];
            });
        } catch (\Exception $e) {
            return ['items' => []];
        }
    }
}
