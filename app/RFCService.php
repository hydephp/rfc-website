<?php

declare(strict_types=1);

namespace App;

use App\Helpers\GitHub;

class RFCService
{
    public function handle(): void
    {
        $issues = GitHub::request('get', 'issues', ['labels' => 'RFC']);
        $pulls = GitHub::request('get', 'pulls', ['labels' => 'RFC']);
    }
}
