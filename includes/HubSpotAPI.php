<?php

namespace WCHubSpot;

class HubSpotAPI
{
    /**
     * TODO:
     * Replace with real token.
     */
    private const ACCESS_TOKEN = 'PUT_HUBSPOT_TOKEN_HERE';

    /**
     * TODO:
     * Replace if HubSpot API changes.
     */
    private const API_URL =
        'https://api.hubapi.com/crm/v3/objects/contacts';

    public function createContact(array $contact)
    {
        $body = [
            'properties' => [
                'email'     => $contact['email'],
                'firstname' => $contact['firstname'],
                'lastname'  => $contact['lastname'],
                'phone'     => $contact['phone'],
            ]
        ];

        return wp_remote_post(
            self::API_URL,
            [
                'headers' => [
                    'Authorization' =>
                        'Bearer ' . self::ACCESS_TOKEN,

                    'Content-Type' =>
                        'application/json',
                ],

                'body' => wp_json_encode($body),

                'timeout' => 20,
            ]
        );
    }
}