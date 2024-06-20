<?php

declare(strict_types=1);

namespace App;

use App\Types\Issue;
use Hyde\Pages\MarkdownPage;

class RFCPage extends MarkdownPage
{
    protected Issue $issue;

    public function __construct(Issue $issue)
    {
        parent::__construct("rfc/$issue->number");

        $this->issue = $issue;
    }
}
