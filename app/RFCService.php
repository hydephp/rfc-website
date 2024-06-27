<?php

declare(strict_types=1);

namespace App;

use Hyde\Hyde;
use App\Types\Issue;
use App\Types\Status;
use DateTimeImmutable;
use App\Helpers\GitHub;
use App\Types\IssueType;
use App\Types\IssueList;
use App\Types\GitHubUser;
use Illuminate\Support\Arr;
use Hyde\Markdown\Models\Markdown;

class RFCService
{
    protected IssueList $rfcs;

    public function handle(): void
    {
        $this->rfcs = $this->getRfcListFromGitHub();

        $this->generateRfcPages();
    }

    protected function getRfcListFromGitHub(): IssueList
    {
        $issues = GitHub::search(['label:RFC', 'is:issue']);
        $pulls = GitHub::search(['label:RFC', 'is:pr']);
        // $discussions = GitHub::rawSearch('repo%3Ahydephp%2Fdevelop+rfc&type=discussions');

        // More efficient way to find the user data not included by search data, using unique users to reduce API calls.
        $userCache = $this->getUserCache(Arr::unique([...Arr::pluck($issues['items'], 'user.login'), ...Arr::pluck($pulls['items'], 'user.login')]));
        $userCache = Arr::keyBy($userCache, fn ($user) => $user['login']);

        $issues = Arr::map($issues['items'], function (array $issue) use ($userCache): Issue {
            return new Issue(
                $issue['number'],
                $issue['title'],
                new Markdown($issue['body']),
                new GitHubUser($issue['user']['login'], ($userCache[$issue['user']['login']])['name']),
                IssueType::Issue,
                $this->getStatus($issue['state']), // Todo: Determine the status
                [], // Todo: Get the comments
                new DateTimeImmutable($issue['created_at']),
                new DateTimeImmutable($issue['updated_at']),
            );
        });

        $pulls = Arr::map($pulls['items'], function (array $pull) use ($userCache): Issue {
            return new Issue(
                $pull['number'],
                $pull['title'],
                new Markdown($pull['body'] ?? ''),
                new GitHubUser($pull['user']['login'], ($userCache[$pull['user']['login']])['name']),
                IssueType::PullRequest,
                $this->getStatus($pull['state']), // Todo: Determine the status
                [], // Todo: Get the comments
                new DateTimeImmutable($pull['created_at']),
                new DateTimeImmutable($pull['updated_at']),
            );
        });

        return new IssueList([...$issues, ...$pulls]);
    }

    public function getItems(): IssueList
    {
        return $this->rfcs;
    }

    protected function generateRfcPages(): void
    {
        $this->rfcs->issues()->each(function (Issue $issue): void {
            $page = new RFCPage($issue);
            Hyde::pages()->addPage($page);
            Hyde::routes()->addRoute($page->getRoute());
        });
    }

    protected function getUserCache($usersToCache): array
    {
        return Arr::map($usersToCache, function (string $username): array {
            return $this->getGitHubUserData($username);
        });
    }

    protected function getGitHubUserData(string $username): array
    {
        return GitHub::request('get', 'users/'.$username);
    }

    protected function getStatus($state): Status
    {
        return match ($state) {
            'open' => Status::Draft,
            'closed' => Status::Implemented,
            default => Status::Stale,
        };
    }
}
