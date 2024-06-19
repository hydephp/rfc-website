<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

/**
 * General GitHub Facade.
 */
class GitHub
{
    /**
     * The repository name on GitHub.
     */
    public const string REPOSITORY = 'hydephp/develop';

    /**
     * Create a GitHub API request.
     */
    public static function request(string $method, string $uri, array $data = []): array
    {
        $cacheKey = 'api-request-'.sha1(date('Y').$method.$uri.json_encode($data));

        return Cache::rememberForever($cacheKey, function () use ($method, $uri, $data): array {
            return Http::withToken(env('GITHUB_TOKEN'))
                ->withHeaders([
                    'Accept' => 'application/vnd.github.v3+json',
                    'User-Agent' => 'HydePHP (hydephp.com)',
                    'X-GitHub-Api-Version' => '2022-11-28',
                ])
                ->$method('https://api.github.com/repos/'.self::REPOSITORY."/$uri", $data)
                ->throw()->json();
        });
    }

    /**
     * Create a GitHub Search API request.
     */
    public static function search(array $data = []): array
    {
        $url = 'https://api.github.com/search/issues?q=repo:'.self::REPOSITORY.urlencode(' '.implode(' ', $data));

        return Http::withToken(env('GITHUB_TOKEN'))
            ->withHeaders([
                'Accept' => 'application/vnd.github.v3+json',
                'User-Agent' => 'HydePHP (hydephp.com)',
                'X-GitHub-Api-Version' => '2022-11-28',
            ])
            ->get($url)
            ->throw()->json();
    }
}
