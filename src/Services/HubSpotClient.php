<?php

namespace WCHubSpot\Services;

use WCHubSpot\Contracts\LoggerInterface;

class HubSpotClient
{
    private LoggerInterface $logger;
    private string $accessToken;

    public function __construct(
        LoggerInterface $logger,
        string $accessToken
    ) {
        $this->logger = $logger;
        $this->accessToken = $accessToken;
    }

    public function sendLead(array $leadData): void
    {
        $json = wp_json_encode($leadData);

        if($json === false){
            throw new \Exception("Failed to encode lead data to JSON: ");
        }

        $response = wp_remote_post('https://api.hubapi.com/crm/v3/objects/contacts', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type'  => 'application/json',
            ],
            'body' => $json,
        ]);


        if (is_wp_error($response)) {
            throw new \Exception("HTTP request failed: " . $response->get_error_message());
        }

        $this->logger->log("Sending lead data to HubSpot");
        $this->logger->log("Lead data: " . $json);
        $this->logger->log(
            'Status code: ' . wp_remote_retrieve_response_code($response)
        );
        $this->logger->log(
            "Response: " . wp_remote_retrieve_body($response)
        );

    }
}