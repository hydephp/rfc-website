<?php

declare(strict_types=1);

namespace App\Types;

use Stringable;
use Carbon\Carbon;
use DateTimeImmutable;
use Illuminate\Support\HtmlString;

class CarbonDate implements Stringable
{
    protected Carbon $date;

    public function __construct(DateTimeImmutable $date)
    {
        $this->date = Carbon::instance($date);
    }

    public function __toString(): string
    {
        return $this->date->format('Y-m-d H:i:s \U\T\C');
    }

    public function toShortHtml(): HtmlString
    {
        return new HtmlString($this->date->format('M j, Y'));
    }

    public function toHtml(): HtmlString
    {
        $date = $this->date->format('F j, Y');
        $time = $this->date->format('H:i A');

        return new HtmlString(sprintf('%s <span class="text-muted">%s</span>', $date, $time));
    }
}
