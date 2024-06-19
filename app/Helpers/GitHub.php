<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

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
     * Create a pending API request.
     */
    public static function request(string $method, string $uri, array $data = []): PendingRequest
    {
        return Http::withToken(env('GITHUB_TOKEN'))
            ->withHeaders(['Accept' => 'application/vnd.github.v3+json'])
            ->$method("https://api.github.com/repos/".self::REPOSITORY."/$uri", $data)->throw();
    }
}
