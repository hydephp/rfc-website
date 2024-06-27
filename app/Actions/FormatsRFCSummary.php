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

        return substr($body, 0, 200).'...';
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
}
