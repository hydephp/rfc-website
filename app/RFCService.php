<?php

declare(strict_types=1);

namespace App;

use App\Types\Issue;
use App\Types\Status;
use DateTimeImmutable;
use App\Helpers\GitHub;
use App\Types\IssueType;
use App\Types\GitHubUser;
use Illuminate\Support\Arr;
use Hyde\Markdown\Models\Markdown;

class RFCService
{
    public function handle(): void
    {
        $data = GitHub::search(['label:RFC', 'is:issue', 'is:pr']);
        // $discussions = GitHub::rawSearch('repo%3Ahydephp%2Fdevelop+rfc&type=discussions');

        $issues = GitHub::request('get', 'issues', ['state' => 'all', 'labels' => 'RFC', 'per_page' => 100]);
        $pulls = GitHub::request('get', 'pulls', ['state' => 'all', 'labels' => 'RFC', 'per_page' => 100]);

        $issues = Arr::map($issues, function (array $issue): Issue {
            return new Issue(
                $issue['number'],
                $issue['title'],
                new Markdown($issue['body']),
                new GitHubUser($issue['user']['login']),
                IssueType::Issue,
                Status::Draft, // Todo: Determine the status
                [], // Todo: Get the comments
                new DateTimeImmutable($issue['created_at']),
                new DateTimeImmutable($issue['updated_at']),
            );
        });

        $pulls = Arr::map($pulls, function (array $pull): Issue {
            dump($pull['labels']);
            return new Issue(
                $pull['number'],
                $pull['title'],
                new Markdown($pull['body'] ?? ''),
                new GitHubUser($pull['user']['login']),
                IssueType::PullRequest,
                Status::Draft, // Todo: Determine the status
                [], // Todo: Get the comments
                new DateTimeImmutable($pull['created_at']),
                new DateTimeImmutable($pull['updated_at']),
            );
        });
    }
}
