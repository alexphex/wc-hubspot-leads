<?php

namespace WCHubSpot;

class Logger
{
    public function info(string $message): void
    {
        error_log('[WC HUBSPOT] INFO: ' . $message);
    }

    public function error(string $message): void
    {
        error_log('[WC HUBSPOT] ERROR: ' . $message);
    }
}
