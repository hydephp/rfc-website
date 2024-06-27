<?php

declare(strict_types=1);

namespace App\Actions;

use Hyde\Framework\Actions\ConvertsMarkdownToPlainText;

class FormatsRFCSummary
{
    public static function handle(string $markdown): string
    {
        $markdown = static::preprocessSummary($markdown);
        $body = (new ConvertsMarkdownToPlainText($markdown))->execute();

        return static::truncateBody($body);
    }

    protected static function preprocessSummary(string $markdown): string
    {
        $lines = explode("\n", trim($markdown));

        $lines = static::removeAllHeadings($lines);

        return trim(implode("\n", $lines));
    }

    protected static function removeAllHeadings(array $lines): array
    {
        return array_filter($lines, fn (string $line): bool => ! str_starts_with($line, '#'));
    }

    protected static function truncateBody(string $body): string
    {
        // Truncate ensuring it doesn't end with a partial word.
        return preg_replace('/\s+?(\S+)?$/', '', substr($body, 0, 200));
    }
}
