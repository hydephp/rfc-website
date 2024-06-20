<?php

declare(strict_types=1);

namespace App;

use App\Types\Issue;
use Hyde\Pages\MarkdownPage;

class RFCPage extends MarkdownPage
{
    public static string $outputDirectory = 'rfc';

    protected Issue $issue;

    public function __construct(Issue $issue)
    {
        parent::__construct((string) $issue->number);

        $this->issue = $issue;
    }
}
