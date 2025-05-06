<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    public function index() {
        try {
            // Procurar o feed de notícias em formato JSON (usando cache para melhorar performance)
            $noticias = Cache::remember('noticias_feed', 3600, function () {
                $response = Http::get('https://rss.app/feeds/v1.1/C11CchUv87TQ40Gi.json');
                if ($response->successful()) {
                    return $response->json();
                }
                return ['items' => []];
            });

            return view('pages.news.index', compact('noticias'));
        } catch (\Exception $e) {
            // Em caso de erro, retornar uma estrutura vazia
            return view('pages.news.index', ['noticias' => ['items' => []]]);
        }
    }
}
