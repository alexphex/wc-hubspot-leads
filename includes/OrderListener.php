<?php

namespace WCHubSpot;

class OrderListener
{
    private HubSpotAPI $hubSpotApi;

    private Logger $logger;

    public function __construct(
        HubSpotAPI $hubSpotApi,
        Logger $logger
    ) {
        $this->hubSpotApi = $hubSpotApi;
        $this->logger = $logger;

        add_action(
            'woocommerce_checkout_order_processed',
            [$this, 'handleOrder'],
            10,
            1
        );
    }

    public function handleOrder(int $orderId): void
    {
        $order = wc_get_order($orderId);

        if (!$order) {
            $this->logger->error(
                'Order not found: ' . $orderId
            );

            return;
        }

        $contact = [
            'email'     => $order->get_billing_email(),
            'firstname' => $order->get_billing_first_name(),
            'lastname'  => $order->get_billing_last_name(),
            'phone'     => $order->get_billing_phone(),
        ];

        $response = $this->hubSpotApi->createContact(
            $contact
        );

        if (is_wp_error($response)) {

            $this->logger->error(
                $response->get_error_message()
            );

            return;
        }

        $statusCode = wp_remote_retrieve_response_code(
            $response
        );

        $this->logger->info(
            'HubSpot response: ' . $statusCode
        );
    }
}