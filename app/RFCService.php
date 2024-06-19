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
        $issues = GitHub::request('get', 'issues', ['state' => 'all', 'labels' => 'RFC']);
        $pulls = GitHub::request('get', 'pulls', ['state' => 'all', 'labels' => 'RFC']);

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
    }
}
