<?php

namespace WCHubSpot;

class Plugin
{
    public function run(): void
    {
        $logger = new Logger();

        $logger->info('Plugin started');

        $hubspotApi = new HubSpotAPI();

        new SettingsPage();

        new OrderListener(
            $hubspotApi,
            $logger
        );
    }
}



