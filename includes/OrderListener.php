<?php

namespace WCHubSpot;

class OrderListener
{
    private HubSpotAPI $hubspot;
    private Logger $logger;

    public function __construct(
        HubSpotAPI $hubspot,
        Logger $logger
    ) {
        $this->hubspot = $hubspot;
        $this->logger  = $logger;

        add_action(
            'woocommerce_checkout_order_processed',
            [$this, 'handleOrder'],
            10,
            1
        );
    }

    public function handleOrder(int $order_id): void
    {
        $order = wc_get_order($order_id);

        if (!$order) {
            return;
        }

        $contact = [
            'email'      => $order->get_billing_email(),
            'firstname'  => $order->get_billing_first_name(),
            'lastname'   => $order->get_billing_last_name(),
            'phone'      => $order->get_billing_phone(),
        ];

        $result = $this->hubspot->createContact($contact);

        if (is_wp_error($result)) {

            $this->logger->error(
                'HubSpot error: ' . $result->get_error_message()
            );

            return;
        }

        $this->logger->info(
            'Contact synced. Order #' . $order_id
        );
    }
}