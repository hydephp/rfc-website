<?php

namespace App;

use Hyde\Console\Concerns\Command;

// Check if this file was called directly
if (isset($argv) && realpath($argv[0]) === __FILE__) {
    chdir(__DIR__.'/..');
    passthru('php hyde rfc');
    exit;
}

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
        $service->handle();

        dd($service);
    }
}
