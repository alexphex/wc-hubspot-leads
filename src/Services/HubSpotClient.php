<?php

namespace WCHubSpot\Services;

use WCHubSpot\Contracts\LoggerInterface;

class HubSpotClient
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function sendLead(array $leadData): void
    {
        $this->logger->log('Sending lead to HubSpot');
    }
}