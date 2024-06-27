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

    public function toHtml(bool $shortMonth = false, bool $showTime = true): HtmlString
    {
        $month = $shortMonth ? 'M' : 'F';

        $date = $this->date->format("$month j, Y");
        if (! $showTime) {
            return new HtmlString($date);
        }
        $time = $this->date->format('H:i A');

        return new HtmlString(sprintf('%s <span class="text-muted">%s</span>', $date, $time));
    }
}
