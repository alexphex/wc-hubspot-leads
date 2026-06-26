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

    public function createContact(array $contact): array
    {
        if (empty($this->token)) {
            return [
                'success' => false,
                'message' => 'HubSpot token is not configured.',
            ];
        }

        $body = [
            'properties' => [
                'email'     => $contact['email'] ?? '',
                'firstname' => $contact['firstname'] ?? '',
                'lastname'  => $contact['lastname'] ?? '',
                'phone'     => $contact['phone'] ?? '',
            ],
        ];

        $response = wp_remote_post(
            self::API_URL,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Content-Type'  => 'application/json',
                ],
                'body'    => wp_json_encode($body),
                'timeout' => 20,
            ]
        );

        if (is_wp_error($response)) {
            return [
                'success' => false,
                'message' => $response->get_error_message(),
            ];
        }

        $statusCode = wp_remote_retrieve_response_code($response);
        $responseBody = wp_remote_retrieve_body($response);

        switch ($statusCode) {

            case 201:
                return [
                    'success' => true,
                    'message' => 'Contact created successfully.',
                ];

            case 409:
                return [
                    'success' => false,
                    'message' => 'Contact already exists.',
                ];

            case 400:
                return [
                    'success' => false,
                    'message' => 'Bad request: ' . $responseBody,
                ];

            case 401:
                return [
                    'success' => false,
                    'message' => 'Unauthorized. Check HubSpot token.',
                ];

            case 403:
                return [
                    'success' => false,
                    'message' => 'Forbidden. Check HubSpot scopes.',
                ];

            default:
                return [
                    'success' => false,
                    'message' => sprintf(
                        'HubSpot returned HTTP %d. %s',
                        $statusCode,
                        $responseBody
                    ),
                ];
        }
    }
}