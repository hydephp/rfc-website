<?php

declare(strict_types=1);

namespace App;

use Carbon\Carbon;
use App\Types\Issue;
use App\Types\GitHubUser;
use Hyde\Pages\MarkdownPage;
use Illuminate\Support\HtmlString;

/**
 * @property-read string $title
 * @property-read GitHubUser $author
 * @property-read Carbon $created
 * @property-read Carbon $updated
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
            'created' => Carbon::parse($issue->created),
            'updated' => Carbon::parse($issue->updated),
        ], $issue->body);

        $this->issue = $issue;
    }

    public function __get(string $name)
    {
        return $this->matter($name);
    }

    public function formatDate(Carbon $carbon): HtmlString
    {
        return new HtmlString(sprintf('%s <span class="text-muted">%s</span>',$carbon->format('F j, Y'), $carbon->format('H:i A')));
    }
}
