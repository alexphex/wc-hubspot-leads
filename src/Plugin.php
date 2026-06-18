<?php

namespace WCHubSpot;

use WCHubSpot\Contracts\LoggerInterface;
use WCHubSpot\Services\HubSpotClient;

class Plugin
{
    private LoggerInterface $logger;
    private HubSpotClient $hubSpotClient;

    public function __construct(
        LoggerInterface $logger,
        HubSpotClient $hubSpotClient
    ) {
        $this->logger = $logger;
        $this->hubSpotClient = $hubSpotClient;
    }

    public function init(): void
    {
        $this->logger->log('Plugin loaded');

        $this->hubSpotClient->sendLead([]);
    }
}