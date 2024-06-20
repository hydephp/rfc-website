<?php

namespace App\Types;

use Illuminate\Contracts\Support\Htmlable;

/**
 * The RFC Status Type, tied to the GitHub issue or pull request outcome.
 */
enum Status implements Htmlable
{
    /**
     * The RFC is still in the draft stage. Only applies to PR RFCs.
     */
    case Draft;

    /**
     * The RFC has been implemented. (The PR has been merged, or the issue has been closed with a resolution.)
     */
    case Implemented;

    /**
     * The RFC has been rejected. (The PR has been closed without merging, or the issue has been closed without resolution.)
     */
    case Rejected;

    /**
     * The RFC is held back for further discussion. (No activity has been seen for a while.)
     */
    case Stale;

    public function toHtml(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Implemented => 'Implemented',
            self::Rejected => 'Rejected',
            self::Stale => 'Stale',
        };
    }
}
