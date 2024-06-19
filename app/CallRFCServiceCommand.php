<?php

namespace App;

use Hyde\Console\Concerns\Command;

/**
 * @experimental Gateway to test the RFC Service
 */
class CallRFCServiceCommand extends Command
{
    protected $signature = 'rfc';

    protected $description = 'Test the RFC Service';

    public function handle(): never
    {
        $service = new RFCService();

        dd($service);
    }
}
