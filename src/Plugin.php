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

        $leadData = [
            'email' => 'john@example.com',
            'first_name' => 'John',
        ];

        $this->logger->log('Plugin loaded');

        try{
            $this->hubSpotClient->sendLead($leadData);
        } catch (\Exception $e){
            $this->logger->log("Error sending test lead: " . $e->getMessage());
        }
    }
}