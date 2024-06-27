<?php

declare(strict_types=1);

namespace App\Types;

use Carbon\Carbon;
use DateTimeImmutable;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\Support\Htmlable;

class CarbonDate implements Htmlable
{
    protected Carbon $date;

    public function __construct(DateTimeImmutable $date)
    {
        $this->date = Carbon::instance($date);
    }

    public function toHtml(): HtmlString
    {
        return new HtmlString(sprintf('%s <span class="text-muted">%s</span>', $this->date->format('F j, Y'), $this->date->format('H:i A')));
    }
}
