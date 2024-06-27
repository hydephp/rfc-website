<?php

declare(strict_types=1);

namespace App;

use App\Types\GitHubUser;
use App\Types\Issue;
use App\Types\CarbonDate;
use Hyde\Pages\MarkdownPage;

/**
 * @property-read string $title
 * @property-read GitHubUser $author
 * @property-read CarbonDate $created
 * @property-read CarbonDate $updated
 */
class RFCPage extends MarkdownPage
{
    public static string $outputDirectory = 'rfc';
    public static string $template = 'rfc';

    public readonly Issue $issue;

    public function __construct(Issue $issue)
    {
        parent::__construct((string) $issue->number, [
            'title' => $issue->prettyTitle,
            'author' => $issue->author,
            'created' => new CarbonDate($issue->createdAt),
            'updated' => new CarbonDate($issue->updatedAt),
        ], $issue->body);

        $this->issue = $issue;
    }

    public function __get(string $name)
    {
        return $this->matter($name);
    }
}
