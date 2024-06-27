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
    protected array $userCache;

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
        $this->userCache = $this->makeUserCache($issues['items'], $pulls['items']);

        $issues = Arr::map($issues['items'], function (array $issue): Issue {
            return new Issue(
                $issue['number'],
                $issue['title'],
                new Markdown($issue['body']),
                $this->getUser($issue['user']),
                IssueType::Issue,
                $this->getStatus($issue['state']),
                [], // Todo: Get the comments
                new DateTimeImmutable($issue['created_at']),
                new DateTimeImmutable($issue['updated_at']),
            );
        });

        $pulls = Arr::map($pulls['items'], function (array $pull): Issue {
            return new Issue(
                $pull['number'],
                $pull['title'],
                new Markdown($pull['body'] ?? ''),
                $this->getUser($pull['user']),
                IssueType::PullRequest,
                $this->getStatus($pull['state']),
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

    protected function makeUserCache(array $issues, array $pulls): array
    {
        $userCache = $this->getUserCache(array_unique([...Arr::pluck($issues, 'user.login'), ...Arr::pluck($pulls, 'user.login')]));

        return Arr::keyBy($userCache, fn (array $user): string => $user['login']);
    }

    protected function getUserCache(array $usersToCache): array
    {
        return Arr::map($usersToCache, function (string $username): array {
            return $this->getGitHubUserData($username);
        });
    }

    protected function getGitHubUserData(string $username): array
    {
        return GitHub::request('get', 'users/'.$username);
    }

    protected function getUser(array $user): GitHubUser
    {
        return new GitHubUser($user['login'], ($this->userCache[$user['login']])['name']);
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
