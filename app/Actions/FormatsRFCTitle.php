<?php

declare(strict_types=1);

namespace App\Actions;

class FormatsRFCTitle
{
    protected final const string TITLE_FORMAT = 'RFC %d: %s';

    public static function handle(int $number, string $title): string
    {
        return self::prettyTitle($number, $title);
    }

    protected static function prettyTitle(int $number, string $title): string
    {
        return sprintf(self::TITLE_FORMAT, $number, self::trimTitleAffixes($title));
    }

    protected static function trimTitleAffixes(string $title): string
    {
        if (str_starts_with($title, 'RFC')) {
            $title = substr($title, 3);
        }

        if (str_ends_with($title, 'RFC')) {
            $title = substr($title, 0, -3);
        }

        if (str_ends_with($title, '(RFC)')) {
            $title = substr($title, 0, -5);
        }

        return trim($title, ' :');
    }
}
