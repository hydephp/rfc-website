<?php

namespace App\Types;

/**
 * The RFC Status Type, tied to the GitHub issue or pull request outcome.
 */
enum Status
{
    case Draft;
    case Implemented;
    case Rejected;
    case Stale;
}
