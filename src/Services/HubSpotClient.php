<?php

namespace WCHubSpot\Services;

use WCHubSpot\Contracts\LoggerInterface;
use WCHubSpot\Exceptions\HubSpotException;

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
            throw new HubSpotException("Failed to encode lead data to JSON");
        }

        $response = wp_remote_post('https://api.hubapi.com/crm/v3/objects/contacts', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type'  => 'application/json',
            ],
            'body' => $json,
        ]);


        if (is_wp_error($response)) {
            throw new HubSpotException("HTTP request failed: " . $response->get_error_message());
        }

        $statusCode = wp_remote_retrieve_response_code($response);

        if ($statusCode >= 400) {
            throw new HubSpotException(
                'HubSpot API returned status code: ' . $statusCode
            );
        }

        $this->logger->log("Status Code: " . $statusCode);

    }
}