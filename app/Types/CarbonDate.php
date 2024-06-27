<?php

declare(strict_types=1);

namespace App\Types;

use Carbon\Carbon;
use DateTimeImmutable;

class CarbonDate
{
    protected Carbon $date;

    public function __construct(DateTimeImmutable $date)
    {
        $this->date = Carbon::instance($date);
    }
}
