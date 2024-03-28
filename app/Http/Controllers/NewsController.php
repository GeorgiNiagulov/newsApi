<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\UserPreference;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Exception\GuzzleException;

class NewsController extends Controller
{

    public function fetchNewsArticles()
    {
        $user = Auth::user();
        $userPreferences = UserPreference::where('user_id', $user->id)->first();

        $errors = [];

        if (!$userPreferences) {
            $errors = ['No user preferences'];
            return view('dashboard', compact('errors'));
        }

        $apiKey = config('services.newsapi.api_key');
        $categories = json_decode($userPreferences->categories, true);

        if (empty($categories)) {
            $errors = ['No chosen category'];
            return view('dashboard', compact('errors'));
        }

        $cacheKey = 'news_for_user_' . $user->id;
        $newsArticles = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($categories, $apiKey) {
            $client = new Client();
            try {
                $response = $client->get('https://newsapi.org/v2/everything', [
                    'verify' => 'C:\\xampp\\php\\extras\\ssl\\cacert.pem',
                    'query' => [
                        'q' => implode(', ', $categories),
                        'apiKey' => $apiKey,
                    ],
                ]);

                $articles =  json_decode($response->getBody()->getContents(), true)['articles'];

                foreach ($articles as &$article) {
                    $article['id'] = $article['url'];
                }

                return $articles;

            } catch (GuzzleException $e) {
                Log::error('Failed to fetch news articles: ' . $e->getMessage());
                return [];
            }
        });


        if (empty($newsArticles)) {
            $errors[] = 'Failed to fetch news articles or no articles found.';
        }

        return view('dashboard', compact('newsArticles', 'errors'));
    }

    public function show($hash)
    {
        $user = Auth::user();
        $cacheKey = 'news_for_user_' . $user->id;
        $newsArticles = Cache::get($cacheKey);

        $article = collect($newsArticles)->first(function ($value) use ($hash) {
            return md5($value['id']) === $hash;
        });

        return view('article', compact('article'));
    }
}
