<?php

namespace WCHubSpot;

use WCHubSpot\Services\Logger;
use WCHubSpot\Contracts\LoggerInterface;

class Plugin
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function init(): void
    {
        $this->logger->log('Plugin loaded');
    }
}