<?php

namespace WCHubSpot;

class HubSpotAPI
{
    private const API_URL =
        'https://api.hubapi.com/crm/v3/objects/contacts';

    private string $token;

    public function __construct()
    {
        $this->token = get_option(
            'wc_hubspot_token',
            ''
        );
    }

    public function createContact(array $contact): array|\WP_Error
    {
        if (empty($this->token)) {
            return new \WP_Error(
                'missing_token',
                'HubSpot token is not configured.'
            );
        }

        $body = [
            'properties' => [
                'email'     => $contact['email'] ?? '',
                'firstname' => $contact['firstname'] ?? '',
                'lastname'  => $contact['lastname'] ?? '',
                'phone'     => $contact['phone'] ?? '',
            ],
        ];

        return wp_remote_post(
            self::API_URL,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Content-Type'  => 'application/json',
                ],

                'body' => wp_json_encode($body),

                'timeout' => 20,
            ]
        );
    }
}