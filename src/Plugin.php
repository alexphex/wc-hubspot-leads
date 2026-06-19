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

        try{
            $this->hubSpotClient->sendLead([
                'email' => 'john@example.com',
                'first_name' => 'John',
            ]);
        } catch (\Exception $e){
            $this->logger->log("Error sending test lead: " . $e->getMessage());
        }
    }
}