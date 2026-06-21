<?php

namespace WCHubSpot;

use WCHubSpot\Services\Logger;
use WCHubSpot\Services\HubSpotClient;

class Bootstrap
{
    public function run(): void
    {
        $logger = new Logger();

        $accessToken = 'demo-token';

        $hubSpotClient = new HubSpotClient(
            $logger,
            $accessToken
        );

        $plugin = new Plugin(
            $logger,
            $hubSpotClient
        );

        $plugin->init();
    }
}