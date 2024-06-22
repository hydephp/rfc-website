<?php

declare(strict_types=1);

namespace App;

use App\Types\Issue;
use App\Types\GitHubUser;
use Hyde\Pages\MarkdownPage;

/**
 * @property-read string $title
 * @property-read GitHubUser $author
 * @property-read string $created
 * @property-read string $updated
 */
class RFCPage extends MarkdownPage
{
    public static string $outputDirectory = 'rfc';
    public static string $template = 'rfc';

    protected Issue $issue;

    public function __construct(Issue $issue)
    {
        parent::__construct((string) $issue->number, [
            'title' => $issue->prettyTitle,
            'author' => $issue->author,
            'created' => $issue->created,
            'updated' => $issue->updated,
        ], $issue->body);

        $this->issue = $issue;
    }

    public function __get(string $name)
    {
        return $this->matter($name);
    }
}
