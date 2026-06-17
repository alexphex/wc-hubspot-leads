<?php

namespace WCHubSpot\Services;

use WCHubSpot\Contracts\LoggerInterface;

class Logger implements LoggerInterface {
    
    public function log(string $message): void
    {
        error_log('[WC HubSpot] ' .$message);
    }
}